<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'google_id' => $this->faker->unique()->regexify('[A-Za-z0-9]{20}'),
            'google_verified_at' => $this->faker->boolean(50) ? now() : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
