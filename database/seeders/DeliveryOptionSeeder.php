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
        DeliveryOption::create([
            'name' => 'delivery',
            'price' => 5
        ]);

        DeliveryOption::create([
            'name' => 'self-pick up',
            'price' => 2.5
        ]);
    }
}
