<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(CampusSeeder::class);
        $this->call(CategorySeeder::class);

        $this->call(TransactionSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(ComplaintSeeder::class);

        $this->call(DeliveryOptionSeeder::class);
        $this->call(FeedbackSeeder::class);

        $this->call(OutletSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(InventoryOutletSeeder::class);

        $this->call(PackageSeeder::class);
        $this->call(OrderSeeder::class);

        $this->call(RiderSeeder::class);
    }
}
