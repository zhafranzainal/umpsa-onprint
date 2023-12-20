<?php

namespace Database\Factories;

use App\Models\Rider;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_commission' => $this->faker->randomNumber(2),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
