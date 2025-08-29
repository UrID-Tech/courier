<?php

namespace App\Observers;

use App\Enums\DeliveryStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Mail\OrderIsInTransit;
use App\Models\Order;
use App\Models\PaymentTransaction;
use App\Models\TrackingEvent;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        if ($order->status == OrderStatus::InTransit) {
            //create tracking event
            $trackingEvent = new TrackingEvent;
            $trackingEvent->tenant_id = $order->tenant_id;
            $trackingEvent->order_id = $order->id;
            $trackingEvent->location_id = $order->origin_location_id;
            $trackingEvent->status = DeliveryStatus::default();
            $trackingEvent->save();

            if ($order->customer->email) {
                Mail::to($order->customer->email)->queue(new OrderIsInTransit($order));
            }
        }

        if ($order->payment_status = PaymentStatus::Paid) {
            //create payment transaction
            $payment = new PaymentTransaction;
            $payment->order_id = $order->id;
            $payment->amount = $order->price;
            $payment->payment_method = PaymentMethod::Cash;
            $payment->status = PaymentStatus::Completed;
            $payment->save();
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void {}

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
