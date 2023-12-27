<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Outlet;
use Illuminate\Database\Seeder;

class InventoryOutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlets = Outlet::all();
        $inventories = Inventory::all();

        $outlets->each(function ($outlet) use ($inventories) {

            $attachedInventories = rand(1, $inventories->count());

            $outlet->inventories()->attach(
                $inventories->random($attachedInventories)->pluck('id')->toArray(),
                ['quantity' => rand(1, 10)]
            );
        });
    }
}
