<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(15),
            'status' => 'open',
            'delivery_id' => Delivery::inRandomOrder()->pluck('id')->first(),
        ];
    }
}
