<?php

namespace Database\Seeders;

use App\Models\DeliveryOption;
use Illuminate\Database\Seeder;

class DeliveryOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryOption::factory()
            ->count(5)
            ->create();
    }
}
