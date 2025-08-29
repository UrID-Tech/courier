<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //create tenant

        $tenant = Tenant::create([
            'name' => 'Urid Technologies',
            'slug' => 'urid'
        ]);
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'tenant_id' => $tenant->getKey(),
            'user_type' => UserType::BUSINESS->value,
        ]);

        $this->call(RwandaLocationsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(PricingRuleSeeder::class);
    }
}
