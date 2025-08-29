<?php

namespace App\Services;

use App\Models\PricingRule;
use App\Models\Tenant;

class PricingCalculator
{
    /**
     * Calculate estimated price for a shipment
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
            $tenantId = Tenant::first()?->getKey();
        }

        if (! $tenantId || ! $originId || ! $destinationId) {
            return null;
        }

        // Query rules in both directions if reversible
        $rules = PricingRule::where('tenant_id', $tenantId)
            ->where('category_id', $categoryId)
            ->where(function ($q) use ($originId, $destinationId) {
                $q->where(function ($q) use ($originId, $destinationId) {
                    $q->where('origin_location_id', $originId)
                        ->where('destination_location_id', $destinationId);
                })
                    ->orWhere(function ($q) use ($originId, $destinationId) {
                        $q->where('origin_location_id', $destinationId)
                            ->where('destination_location_id', $originId)
                            ->where('is_reversible', true);
                    });
            })
            ->get();

        if ($rules->isEmpty()) {
            return null; // no matching rules
        }

        // Filter rules by weight/dimension constraints
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

        // Use the first valid rule for now
        $rule = $validRules->first();

        // Start with base price
        $price = $rule->base_price;

        // Add weight-based pricing
        if ($rule->price_per_kg) {
            $price += $weight * $rule->price_per_kg;
        }

        // Add dimension-based pricing (volume pricing)
        if ($rule->price_per_dimension) {
            $volume = $length * $width * $height;
            $price += $volume * $rule->price_per_dimension;
        }

        return round($price, 2);
    }
}
