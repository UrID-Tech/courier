<?php

namespace App\Observers;

use App\Enums\DeliveryStatus;
use App\Enums\OrderStatus;
use App\Mail\OrderIsDelivered;
use App\Models\TrackingEvent;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Sms;

class TrackingEventObserver
{
    /**
     * Handle the TrackingEvent "created" event.
     */
    public function created(TrackingEvent $trackingEvent): void
    {
        if ($trackingEvent->status == DeliveryStatus::Delivered) {
            $trackingEvent->order->update(['status' => OrderStatus::Delivered]);
            if ($trackingEvent->order->customer->email) {
                Mail::to($trackingEvent->order->customer->email)->queue(new OrderIsDelivered($trackingEvent->order));
                Sms::send(
                    to: $trackingEvent->order->customer->phone,
                    message: "Your order with tracking number {$trackingEvent->order->tracking_number} is has been delivered.",
                    model: $trackingEvent->order
                );
            }
        }
    }

    /**
     * Handle the TrackingEvent "updated" event.
     */
    public function updated(TrackingEvent $trackingEvent): void
    {
        //
    }

    /**
     * Handle the TrackingEvent "deleted" event.
     */
    public function deleted(TrackingEvent $trackingEvent): void
    {
        //
    }

    /**
     * Handle the TrackingEvent "restored" event.
     */
    public function restored(TrackingEvent $trackingEvent): void
    {
        //
    }

    /**
     * Handle the TrackingEvent "force deleted" event.
     */
    public function forceDeleted(TrackingEvent $trackingEvent): void
    {
        //
    }
}
