<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'category_id',
        'origin_location_id',
        'destination_location_id',
        'base_price',
        'price_per_kg',
        'price_per_dimension',
        'min_weight',
        'max_weight',
        'min_length',
        'max_length',
        'min_width',
        'max_width',
        'min_height',
        'max_height'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
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
}
