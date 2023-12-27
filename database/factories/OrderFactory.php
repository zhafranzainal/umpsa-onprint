<?php

namespace Database\Factories;

use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_file' => $this->faker->file(storage_path('app\public\documents'), public_path('storage\documents'), false),
            'quantity' => $this->faker->randomNumber(2, false),
            'total_price' => $this->faker->randomFloat(2, 5, 100),
            'point' => $this->faker->randomNumber(2),
            'status' => 'pending',
            'qr_code' => $this->faker->image(public_path('storage\images'), 640, 480, null, false),
            'outlet_id' => Outlet::inRandomOrder()->pluck('id')->first(),
            'package_id' => Package::inRandomOrder()->pluck('id')->first(),
            'delivery_option_id' => DeliveryOption::inRandomOrder()->pluck('id')->first(),
            'transaction_id' => Transaction::factory(),
        ];
    }
}
