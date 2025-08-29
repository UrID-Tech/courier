@component('mail::message')

# Hi {{ $order->customer->name }}

The shipment you have ordered is now in Transit.

## Tracking Number: {{ $order->tracking_number }}





@component('mail::button', ['url' => config('app.url').'//tracking/track'])
Track your shipment
@endcomponent





@slot('subcopy')
@component('mail::subcopy')
Best regards,

@endcomponent
@endslot

@endcomponent
