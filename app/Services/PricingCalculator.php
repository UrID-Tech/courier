<?php

namespace App\Services;

use App\Models\PricingRule;
use App\Models\Tenant;

class PricingCalculator
{
    /**
     * Calculate estimated price for a shipment
     *
     * @param string $tenantId
     * @param string $categoryId
     * @param string|null $originId
     * @param string|null $destinationId
     * @param float $weight
     * @param float $length
     * @param float $width
     * @param float $height
     * @return float|null
     */
    public function estimate(
        ?string $tenantId,
        string $categoryId,
        ?string $originId,
        ?string $destinationId,
        float $weight,
        float $length,
        float $width,
        float $height
    ): ?float {
        if (empty($tenantId)) {
            $tenantId = Tenant::first()->getKey();
        }
        // Get all matching rules for tenant + category
        $rules = PricingRule::where('tenant_id', $tenantId)
            ->where('category_id', $categoryId)
            ->when($originId, fn($q) => $q->where('origin_location_id', $originId))
            ->when($destinationId, fn($q) => $q->where('destination_location_id', $destinationId))
            ->get();

        if ($rules->isEmpty()) {
            return null; // no matching rules
        }

        // Filter rules that fit constraints (weight/dimensions)
        $validRules = $rules->filter(function ($rule) use ($weight, $length, $width, $height) {
            return ($rule->min_weight === null || $weight >= $rule->min_weight) &&
                ($rule->max_weight === null || $weight <= $rule->max_weight) &&
                ($rule->min_length === null || $length >= $rule->min_length) &&
                ($rule->max_length === null || $length <= $rule->max_length) &&
                ($rule->min_width === null || $width >= $rule->min_width) &&
                ($rule->max_width === null || $width <= $rule->max_width) &&
                ($rule->min_height === null || $height >= $rule->min_height) &&
                ($rule->max_height === null || $height <= $rule->max_height);
        });

        if ($validRules->isEmpty()) {
            return null;
        }

        // For now, just pick the first valid rule
        $rule = $validRules->first();

        // Start with base price
        $price = $rule->base_price;

        // Add weight-based pricing
        if ($rule->price_per_kg) {
            $price += $weight * $rule->price_per_kg;
        }

        // Add dimension-based pricing (using volume)
        if ($rule->price_per_dimension) {
            $volume = $length * $width * $height; // cm³ or m³ depending on your unit
            $price += $volume * $rule->price_per_dimension;
        }

        return round($price, 2);
    }
}
