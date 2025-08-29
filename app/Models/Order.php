<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'customer_id',
        'tracking_number',
        'category_id',
        'origin_location_id',
        'destination_location_id',
        'weight',
        'length',
        'width',
        'height',
        'price',
        'status',
        'receiver_name',
        'receiver_email',
        'receiver_phone',
        'receiver_address',
        'notes',
        'requires_delivery_confirmation',
        'payment_status'
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function origin()
    {
        return $this->belongsTo(Location::class, 'origin_location_id');
    }

    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_location_id');
    }

    public function trackingEvents()
    {
        return $this->hasMany(TrackingEvent::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->tracking_number)) {
                $order->tracking_number = \App\Helpers\Utils::generateTrackingNumber();
            }
        });
    }
}
