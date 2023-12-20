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
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(CampusSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ComplaintSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(DeliveryOptionSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OutletSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(RiderSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
