<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\PricingRule;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class PricingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant   = Tenant::first();
        $category = Category::first();

        if (! $tenant || ! $category) {
            $this->command->warn('⚠️ No tenant or category found. Skipping PricingRule seeding.');
            return;
        }

        $locations = Location::all();

        foreach ($locations as $origin) {
            foreach ($locations as $destination) {
                // Skip if origin and destination are the same
                if ($origin->id === $destination->id) {
                    continue;
                }

                // Ensure we don’t create duplicate reverse rules
                $exists = PricingRule::where('tenant_id', $tenant->id)
                    ->where('category_id', $category->id)
                    ->where(function ($q) use ($origin, $destination) {
                        $q->where('origin_location_id', $origin->id)
                            ->where('destination_location_id', $destination->id);
                    })
                    ->exists();

                if (! $exists) {
                    PricingRule::create([
                        'tenant_id'               => $tenant->id,
                        'category_id'             => $category->id,
                        'base_price'              => 100.0,
                        'price_per_kg'            => 5.0,
                        'price_per_dimension'     => 5.0,
                        'origin_location_id'      => $origin->id,
                        'destination_location_id' => $destination->id,
                        'min_weight' => 1,
                        'max_weight' => 30,
                        'min_width'               => 1,
                        'max_width'               => 30,
                        'min_length'              => 1,
                        'max_length'              => 30,
                        'min_height'              => 1,
                        'max_height'              => 30,
                        'is_reversible'           => true, // reverse handled by calculator
                    ]);
                }
            }
        }

        $this->command->info('✅ Pricing rules seeded for all location pairs.');
    }
}
