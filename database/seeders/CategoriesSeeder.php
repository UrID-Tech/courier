<?php

namespace Database\Seeders;

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
                'name' => 'Parcel'
            ],
            [
                'description' => 'Envelope or book size packages'
            ]
        );
    }
}
