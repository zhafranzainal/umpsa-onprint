<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fullName = $this->faker->name();
        $words = explode(' ', $fullName);
        $username = $words[0];

        return [
            'campus_id' => Campus::inRandomOrder()->pluck('id')->first(),
            'name' => $fullName,
            'email' => $this->faker->unique->email(),
            'email_verified_at' => now(),
            'username' => $username,
            'password' => Hash::make('password'),
            'mobile_no' => $this->faker->mobileNumber(true, false),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
