<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
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
            'document_file' => $this->faker->text(255),
            'quantity' => $this->faker->randomNumber(),
            'total_price' => $this->faker->randomNumber(2),
            'point' => $this->faker->randomNumber(0),
            'status' => 'pending',
            'qr_code' => $this->faker->text(),
            'outlet_id' => \App\Models\Outlet::factory(),
            'package_id' => \App\Models\Package::factory(),
            'delivery_option_id' => \App\Models\DeliveryOption::factory(),
            'transaction_id' => \App\Models\Transaction::factory(),
        ];
    }
}
