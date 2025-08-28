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
        $prefix = config('courier.order_prefix');
        $year   = now()->format('Y');

        do {
            $randomPart = strtoupper(Str::random(7)); // 7 chars keeps it compact
            $trackingNumber = sprintf('%s-%s-%s', $prefix, $year, $randomPart);
        } while (Order::where('tracking_number', $trackingNumber)->exists());

        return $trackingNumber;
    }
}
