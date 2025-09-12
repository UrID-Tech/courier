<?php

namespace Database\Seeders;

use App\Enums\PricingStrategy;
use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::first();

        $parcel = Category::firstOrCreate(
            [
                'tenant_id' => $tenant->getKey(),
                'name' => 'Cargo'
            ],
            [
                'description' => 'light cargo',
                'pricing_strategy' => PricingStrategy::Weight
            ]
        );
    }
}
