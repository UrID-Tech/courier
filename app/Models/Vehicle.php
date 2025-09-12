<?php

namespace App\Models;

use App\Enums\VehicleCategory;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasUuids, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'category',
        'number_plate',
    ];

    protected $casts = [
        'category' => VehicleCategory::class,
    ];
}
