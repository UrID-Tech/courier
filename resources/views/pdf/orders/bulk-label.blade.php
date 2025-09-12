<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shipping Labels</title>
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
        .label h2 { margin: 0; font-size: 18px; }
        .label p { margin: 2px 0; font-size: 12px; }
        .barcode, .qrcode { margin-top: 10px; }
    </style>
</head>
<body>
    @foreach($orders as $order)
        <div class="label">
            <h2>{{ config('app.name')}}</h2>
            <p><strong>Tracking #:</strong> {{ $order->tracking_number }}</p>
            <p><strong>Category:</strong> {{ $order->category->name }}</p>
            <p><strong>From:</strong> {{ $order->origin->name ?? '-' }}</p>
            <p><strong>To:</strong> {{ $order->destination->name ?? '-' }}</p>
            <p><strong>Sender:</strong> {{ $order->customer->name ?? '-' }}</p>
            <p><strong>Receiver:</strong> {{ $order->receiver_name }} ({{ $order->receiver_phone }})</p>
            <p><strong>Weight:</strong> {{ $order->weight }} kg</p>
            <p><strong>Dimensions:</strong> {{ $order->length }} x {{ $order->width }} x {{ $order->height }} cm</p>

            <div class="barcode">
                {!! DNS1D::getBarcodeHTML($order->tracking_number, 'C39', 1, 30) !!}
            </div>
            {{-- <div class="qrcode">
                {!! DNS2D::getBarcodeHTML(route('track.order', $order->tracking_number), 'QRCODE', 3, 3) !!}
            </div> --}}
        </div>
    @endforeach
</body>
</html>
