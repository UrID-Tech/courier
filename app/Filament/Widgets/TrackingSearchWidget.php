<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms;
use App\Models\Order;
use Filament\Notifications\Notification;

class TrackingSearchWidget extends Widget
{
    protected string $view = 'filament.widgets.tracking-search-widget';

    public ?string $trackingNumber = null;

    public array $result = [];

    public function submit(): void
    {
        if (! $this->trackingNumber) {
            Notification::make()
                ->title('Enter a tracking number')
                ->warning()
                ->send();
            return;
        }

        $order = Order::with(['customer', 'category', 'origin', 'destination', 'trackingEvents'])
            ->where('tracking_number', $this->trackingNumber)
            ->first();

        if (! $order) {
            Notification::make()
                ->title("No shipment found for {$this->trackingNumber}")
                ->danger()
                ->send();

            $this->result = [];
            return;
        }

        $this->result = [
            'tracking_number' => $order->tracking_number,
            'status' => $order->status,
            'customer' => $order->customer->name ?? 'N/A',
            'origin' => $order->origin->name ?? 'N/A',
            'destination' => $order->destination->name ?? 'N/A',
            'latest_event' => optional($order->trackingEvents->last())->status ?? 'No events yet',
        ];
    }
}
