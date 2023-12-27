<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Campus::create(['name' => 'UMPSA Pekan']);
        Campus::create(['name' => 'UMPSA Gambang']);
    }
}
