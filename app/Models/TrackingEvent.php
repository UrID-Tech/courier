<?php

namespace App\Models;

use App\Enums\DeliveryStatus;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingEvent extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $fillable = [
        'order_id',
        'location_id',
        'status',
        'remarks',
        'delivered_at',
        'delivered_by',
        'received_by',
        'received_by_phone_number',
        'otp'
    ];

    protected $casts = [
        'status' => DeliveryStatus::class,
        'delivered_at' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
