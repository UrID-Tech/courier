<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shipping Label - {{ $order->tracking_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .label { border: 2px dashed #000; padding: 20px; width: 400px; }
        .header { text-align: center; margin-bottom: 10px; }
        .qrcode, .barcode { text-align: center; margin-top: 10px; }
        .details { margin-top: 15px; }
        .details p { margin: 4px 0; }
    </style>
</head>
<body>
    <div class="label">
        <div class="header">
            <h2>{{ config('app.name')}}</h2>
            <h4>Shipping Label</h4>
        </div>

        <div class="details">
            <p><strong>Tracking #:</strong> {{ $order->tracking_number }}</p>
            <p><strong>Category:</strong> {{ $order->category->name }}</p>
            <p><strong>From:</strong> {{ $order->origin->name }}</p>
            <p><strong>To:</strong> {{ $order->destination->name }}</p>
            <p><strong>Sender:</strong> {{ $order->customer->name ?? '-' }}</p>
            <p><strong>Receiver:</strong> {{ $order->receiver_name }} ({{ $order->receiver_phone }})</p>
            <p><strong>Weight:</strong> {{ $order->weight }} kg</p>
            <p><strong>Dimensions:</strong> {{ $order->length }} x {{ $order->width }} x {{ $order->height }} cm</p>
            {{-- <p><strong>Price:</strong> {{ number_format($order->price, 2) }} {{ config('app.currency', 'USD') }}</p> --}}
        </div>

        <div class="qrcode">
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
        </div>

        <div class="barcode">
            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode">
        </div>
        
        {{-- <div class="qrcode">
            {!! DNS2D::getBarcodeHTML(route('track.order', $order->tracking_number), 'QRCODE', 3, 3) !!}
        </div>
        <div class="barcode">
            {!! DNS1D::getBarcodeHTML($order->tracking_number, 'C39', 1, 30) !!}
        </div> --}}
    </div>
</body>
</html>
