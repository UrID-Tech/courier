<?php

namespace App\Models;

use App\Enums\PricingStrategy;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $fillable = ['name', 'description', 'tenant_id', 'pricing_strategy'];

    protected $casts = [
        'pricing_strategy' => PricingStrategy::class,
    ];
}
