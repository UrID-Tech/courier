<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\Tenant;

class RwandaLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            // Eastern Province
            'Bugesera',
            'Gatsibo',
            'Kayonza',
            'Kirehe',
            'Ngoma',
            'Nyagatare',
            'Rwamagana',
            // Kigali City
            'Kigali',
            'Gasabo',
            'Kicukiro',
            'Nyarugenge',
            // Northern Province
            'Burera',
            'Gakenke',
            'Gicumbi',
            'Musanze',
            'Rulindo',
            // Southern Province
            'Gisagara',
            'Huye',
            'Kamonyi',
            'Muhanga',
            'Nyamagabe',
            'Nyanza',
            'Nyaruguru',
            'Ruhango',
            // Western Province
            'Karongi',
            'Ngororero',
            'Nyabihu',
            'Nyamasheke',
            'Rubavu',
            'Rusizi',
            'Rutsiro',
        ];

        $tenant = Tenant::first();

        foreach ($districts as $name) {
            Location::FirstOrCreate([
                'tenant_id' => $tenant->getKey(),
                'name' => $name
            ]);
        }
    }
}
