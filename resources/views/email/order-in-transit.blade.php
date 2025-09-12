@component('mail::message')

# Hi {{ $order->customer->name }}

The shipment you have ordered is now in Transit.

## Tracking Number: {{ $order->tracking_number }}



<img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(route('track.order', $order->tracking_number), 'QRCODE') }}" alt="QR Code">


@component('mail::button', ['url' => config('app.url').'//tracking/track'])
Track your shipment
@endcomponent





@slot('subcopy')
@component('mail::subcopy')
Best regards,

@endcomponent
@endslot

@endcomponent
