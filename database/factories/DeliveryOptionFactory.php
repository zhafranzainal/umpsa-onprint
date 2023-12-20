<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DeliveryOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryOption::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(1),
        ];
    }
}
