<?php

namespace App\Services;

use App\Models\PricingRule;
use App\Models\Tenant;
use App\Models\Category;

class PricingCalculator
{
    public function estimate(
        ?string $tenantId,
        string $categoryId,
        ?string $originId,
        ?string $destinationId,
        float $weight,
        float $length,
        float $width,
        float $height,
        ?float $shipmentValue = null
    ): ?float {
        if (empty($tenantId)) {
            $tenantId = Tenant::first()->getKey();
        }

        $category = Category::findOrFail($categoryId);

        $rules = PricingRule::where('tenant_id', $tenantId)
            ->where('category_id', $categoryId)
            ->when($originId, fn($q) => $q->where('origin_location_id', $originId))
            ->when($destinationId, fn($q) => $q->where('destination_location_id', $destinationId))
            ->get();

        if ($rules->isEmpty()) {
            return null;
        }

        $validRules = $rules->filter(
            fn($rule) => ($rule->min_weight === null || $weight >= $rule->min_weight) &&
                ($rule->max_weight === null || $weight <= $rule->max_weight) &&
                ($rule->min_length === null || $length >= $rule->min_length) &&
                ($rule->max_length === null || $length <= $rule->max_length) &&
                ($rule->min_width === null || $width >= $rule->min_width) &&
                ($rule->max_width === null || $width <= $rule->max_width) &&
                ($rule->min_height === null || $height >= $rule->min_height) &&
                ($rule->max_height === null || $height <= $rule->max_height)
        );

        if ($validRules->isEmpty()) {
            return null;
        }

        $rule = $validRules->first();
        $price = $rule->base_price ?? 0;

        switch ($category->pricing_strategy) {
            case 'weight':
                $price += $weight * ($rule->price_per_kg ?? 0);
                break;

            case 'dimensions':
                $volume = $length * $width * $height;
                $price += $volume * ($rule->price_per_dimension ?? 0);
                break;

            case 'value':
                if (is_null($shipmentValue)) {
                    throw new \InvalidArgumentException("Shipment value is required for this category.");
                }
                $price += ($shipmentValue * ($rule->value_percentage ?? 0)) / 100;
                break;

            case 'all':
                $price += $weight * ($rule->price_per_kg ?? 0);

                $volume = $length * $width * $height;
                $price += $volume * ($rule->price_per_dimension ?? 0);

                if (is_null($shipmentValue)) {
                    throw new \InvalidArgumentException("Shipment value is required for this category.");
                }
                $price += ($shipmentValue * ($rule->value_percentage ?? 0)) / 100;
                break;

            case 'weight+value':
                $price += $weight * ($rule->price_per_kg ?? 0);

                if (is_null($shipmentValue)) {
                    throw new \InvalidArgumentException("Shipment value is required for this category.");
                }
                $price += ($shipmentValue * ($rule->value_percentage ?? 0)) / 100;
                break;
        }

        return round($price, 2);
    }
}
