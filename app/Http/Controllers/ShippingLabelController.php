<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Milon\Barcode\DNS1D;

class ShippingLabelController extends Controller
{
    /**
     * Generate PDF shipping label for an order.
     */
    public function generate($orderId)
    {
        $order = Order::with(['customer', 'category', 'origin', 'destination'])->findOrFail($orderId);

        // Generate QR code (base64 so it works inside PDF)
        $qrCode = base64_encode(QrCode::format('png')->size(150)->generate(
            route('track.order', ['tracking_number' => $order->tracking_number])
        ));

        // Generate Barcode (base64)
        $barcode = base64_encode(DNS1D::getBarcodePNG($order->tracking_number, 'C128'));

        $pdf = Pdf::loadView('pdf.orders.shipping-label', compact('order', 'qrCode', 'barcode'));

        return $pdf->download("Shipping-Label-{$order->tracking_number}.pdf");
    }

    public function bulkLabel(string $ids)
    {
        $idsArray = explode(',', $ids);
        $orders = Order::whereIn('id', $idsArray)->get();

        $pdf = Pdf::loadView('pdf.orders.bulk-label', compact('orders'))
            ->setPaper('a6'); // each label on small page

        return $pdf->download('shipping-labels.pdf');
    }
}
