<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ShippingLabelService
{
    /**
     * Generate a PDF with multiple order labels and save to storage.
     *
     * @param array $orderIds
     * @return string Path to saved PDF
     */
    public static function generateBulk(array $orderIds): string
    {
        $orders = Order::whereIn('id', $orderIds)->get();

        $pdf = Pdf::loadView('pdf.orders.bulk-label', compact('orders'))
            ->setPaper('a6'); // each label on small page

        // Ensure folder exists
        Storage::disk('public')->makeDirectory('shipping-labels');

        // Generate unique filename
        $fileName = 'shipping-labels/labels-' . now()->format('Ymd-His') . '-' . uniqid() . '.pdf';

        // Save PDF to storage
        Storage::disk('public')->put($fileName, $pdf->output());

        return $fileName; // return relative path (e.g. shipping-labels/labels-20250828-xxxx.pdf)
    }
}
