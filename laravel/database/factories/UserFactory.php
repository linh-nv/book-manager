<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_code' => $this->faker->unique()->randomNumber(6),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'password' => Hash::make('password'),
            'tel' => $this->faker->phoneNumber(),
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->randomElement([1, 3]),
            'role_id' => $this->faker->randomElement([1, 2]),
            'created_at' => $this->faker->dateTimeBetween('year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('year', 'now'),
        ];
    }
}
