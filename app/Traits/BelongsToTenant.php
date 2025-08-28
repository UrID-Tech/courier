<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait BelongsToTenant
{
    public static function bootBelongsToTenant(): void
    {
        // Global scope: filter all queries by tenant_id
        static::addGlobalScope('tenant', function (Builder $builder) {
            if ($user = Auth::user()) {
                if ($user->tenant_id) {
                    $builder->where($builder->getModel()->getTable() . '.tenant_id', $user->tenant_id);
                }
            }
        });

        // Auto-assign tenant_id when creating
        static::creating(function (Model $model) {
            if ($user = Auth::user()) {
                if ($user->tenant_id) {
                    $model->tenant_id = $user->tenant_id;
                } else {
                    throw new ModelNotFoundException("User has no tenant_id when creating: " . get_class($model));
                }
            }
        });
    }
}
