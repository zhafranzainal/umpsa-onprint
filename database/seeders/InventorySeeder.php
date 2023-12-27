<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::create(['name' => 'A4 paper']);
        Inventory::create(['name' => 'ink bottle']);
        Inventory::create(['name' => 'binder']);
        Inventory::create(['name' => 'lamination paper']);
        Inventory::create(['name' => 'solvent']);
    }
}
