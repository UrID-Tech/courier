<?php

namespace App\Helpers;

use App\Models\Order;
use Illuminate\Support\Str;

class Utils
{

    /**
     * Generate a unique 12-character tracking number.
     *
     * @return string
     */
    public static function generateTrackingNumber(): string
    {
        do {
            // Example: ABC123XYZ789
            $trackingNumber = strtoupper(Str::random(12));
        } while (Order::where('tracking_number', $trackingNumber)->exists());

        return $trackingNumber;
    }
}
