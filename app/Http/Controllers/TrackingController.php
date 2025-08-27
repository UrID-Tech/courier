<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class TrackingController extends Controller
{
    /**
     * Track a shipment by tracking number (guest accessible).
     */
    public function track(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tracking_number' => 'required|string|exists:orders,tracking_number',
        ]);

        $order = Order::with([
            'customer',
            'category',
            'origin',
            'destination',
            'trackingEvents' => fn($q) => $q->orderBy('created_at')
        ])->where('tracking_number', $validated['tracking_number'])->first();

        if (! $order) {
            return response()->json([
                'success' => false,
                'message' => 'Shipment not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'tracking_number' => $order->tracking_number,
            'status' => $order->status,
            'category' => $order->category->name ?? null,
            'origin' => $order->origin->name ?? null,
            'destination' => $order->destination->name ?? null,
            'customer' => [
                'name' => $order->customer->name,
                'phone' => $order->customer->phone,
            ],
            'price' => $order->price,
            'weight' => $order->weight,
            'dimensions' => [
                'length' => $order->length,
                'width'  => $order->width,
                'height' => $order->height,
            ],
            'events' => $order->trackingEvents->map(fn($event) => [
                'status' => $event->status,
                'location' => $event->location?->name,
                'remarks' => $event->remarks,
                'timestamp' => $event->created_at->toDateTimeString(),
            ]),
        ]);
    }
}
