<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commission_fee' => $this->faker->randomFloat(2, 5, 30),
            'delivered_date' => $this->faker->dateTime(),
            'transaction_id' => Transaction::inRandomOrder()->pluck('id')->first(),
        ];
    }
}
