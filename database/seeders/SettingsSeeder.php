<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\CompanySetting as Setting;
use App\Services\SettingsManager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = app(SettingsManager::class);

        Tenant::all()->each(function (Tenant $tenant) use ($manager) {
            foreach ($manager->discover() as $class) {
                $key = Str::snake(class_basename($class));

                // Only seed if not already set
                $exists = Setting::withoutGlobalScopes()
                    ->where('tenant_id', $tenant->id)
                    ->where('key', $key)
                    ->exists();

                if (! $exists) {
                    // Let the Data class provide defaults
                    $data = $class::from([]);

                    $manager->forTenant($tenant->id)->set($data);
                }
            }
        });
    }
}
