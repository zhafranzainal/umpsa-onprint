<?php

namespace Database\Factories;

use App\Models\Outlet;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Outlet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'campus_id' => \App\Models\Campus::factory(),
        ];
    }
}
