<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Outlet::create([
            'campus_id' => '1',
            'name' => 'Cooperative Ltd'
        ]);

        Outlet::create([
            'campus_id' => '1',
            'name' => 'Red Cafe'
        ]);

        Outlet::create([
            'campus_id' => '1',
            'name' => 'Pekan Library'
        ]);

        Outlet::create([
            'campus_id' => '2',
            'name' => 'The Machines'
        ]);

        Outlet::create([
            'campus_id' => '2',
            'name' => 'Gambang Library'
        ]);
    }
}
