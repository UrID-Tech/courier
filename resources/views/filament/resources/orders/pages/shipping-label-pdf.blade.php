<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; }
        .label {
            width: 300px;
            height: 200px;
            border: 1px solid #000;
            margin: 10px auto;
            padding: 10px;
            page-break-after: always;
        }
    </style>
</head>
<body>
    @foreach($orders as $order)
        <div class="label">
            <h2>📦 Courier Urid</h2>
            <p><strong>Tracking #:</strong> {{ $order->tracking_number }}</p>
            <p><strong>From:</strong> {{ $order->origin->name ?? '-' }}</p>
            <p><strong>To:</strong> {{ $order->destination->name ?? '-' }}</p>
            <p><strong>Customer:</strong> {{ $order->customer->name ?? '-' }}</p>
            <div>{!! DNS1D::getBarcodeHTML($order->tracking_number, 'C39', 1, 30) !!}</div>
            <div>{!! DNS2D::getBarcodeHTML(route('orders.track', $order->tracking_number), 'QRCODE', 3, 3) !!}</div>
        </div>
    @endforeach
</body>
</html>
