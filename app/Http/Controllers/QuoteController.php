<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PricingCalculator;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
    protected PricingCalculator $calculator;

    public function __construct(PricingCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * Calculate shipment price estimate for guest users.
     */
    public function calculate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tenant_id' => 'nullable|uuid|exists:tenants,id',
            'category_id' => 'required|uuid|exists:categories,id',
            'origin_id' => 'nullable|uuid|exists:locations,id',
            'destination_id' => 'nullable|uuid|exists:locations,id',
            'weight' => 'required|numeric|min:0.1',
            'length' => 'required|numeric|min:0',
            'width'  => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ]);

        $price = $this->calculator->estimate(
            tenantId: $validated['tenant_id'],
            categoryId: $validated['category_id'],
            originId: $validated['origin_id'] ?? null,
            destinationId: $validated['destination_id'] ?? null,
            weight: $validated['weight'],
            length: $validated['length'],
            width: $validated['width'],
            height: $validated['height']
        );

        if (is_null($price)) {
            return response()->json([
                'success' => false,
                'message' => 'No matching pricing rule found for this shipment.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'tenant_id' => $validated['tenant_id'],
            'category_id' => $validated['category_id'],
            'origin_id' => $validated['origin_id'] ?? null,
            'destination_id' => $validated['destination_id'] ?? null,
            'weight' => $validated['weight'],
            'dimensions' => [
                'length' => $validated['length'],
                'width' => $validated['width'],
                'height' => $validated['height'],
            ],
            'estimated_price' => $price,
        ]);
    }
}
