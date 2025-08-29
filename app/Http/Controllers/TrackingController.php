<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class TrackingController extends Controller
{
    public function showForm()
    {
        return view('track');
    }
    /**
     * Track a shipment by tracking number (guest accessible).
     */
    public function track(Request $request)
    {
        $validated = $request->validate([
            'tracking_number' => 'required|string',
        ]);

        $order = Order::with([
            'customer',
            'category',
            'origin',
            'destination',
            'trackingEvents' => fn($q) => $q->orderBy('created_at')
        ])->where('tracking_number', $validated['tracking_number'])->first();

        if (! $order) {
            return redirect()->back()->with('error', 'Shipment not found');
        }

        return redirect()->route('track.form')->with('order', $order);
    }
}
