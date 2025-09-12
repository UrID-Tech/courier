<?php

namespace App\Services;

use App\Models\CompanySetting as Setting;
use Spatie\LaravelData\Data;
use Illuminate\Support\Str;

class SettingsManager
{
    protected ?string $tenantId = null;

    public function forTenant(int|string $tenantId): static
    {
        $this->tenantId = $tenantId;
        return $this;
    }

    /**
     * Resolve tenant_id:
     * - prefer manually set
     * - then Auth::user()
     * - else fallback to null
     */
    protected function resolveTenantId(?object $context = null): ?string
    {
        if ($this->tenantId) {
            return $this->tenantId;
        }

        if ($context && property_exists($context, 'tenant_id')) {
            return $context->tenant_id;
        }

        if (auth()->check()) {
            return auth()->user()->tenant_id;
        }

        return null;
    }

    /**
     * Get settings data object for tenant
     */
    public function get(string $class, ?object $context = null): Data
    {
        $tenantId = $this->resolveTenantId($context);

        $key = Str::snake(class_basename($class));

        $setting = Setting::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where('key', $key)
            ->first();

        if (! $setting) {
            return $class::from([]); // defaults
        }

        return $class::from($setting->value);
    }

    /**
     * Save settings data
     */
    public function set(Data $data, ?object $context = null): void
    {
        $tenantId = $this->resolveTenantId($context);

        $key = Str::snake(class_basename($data));

        Setting::updateOrCreate(
            [
                'tenant_id' => $tenantId,
                'key'       => $key,
            ],
            [
                'value'     => $data->toArray(),
            ]
        );
    }

    /**
     * Auto-discover settings classes
     */
    public function discover(): array
    {
        $path = app_path('Settings');
        $classes = [];

        foreach (glob($path . '/*.php') as $file) {
            $class = 'App\\Settings\\' . basename($file, '.php');
            if (class_exists($class)) {
                $classes[] = $class;
            }
        }

        return $classes;
    }
}
