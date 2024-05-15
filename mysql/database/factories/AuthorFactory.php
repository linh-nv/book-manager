<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
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
            'biography' => $this->faker->paragraph,
            'birthdate' => $this->faker->date,
            'nationality' => $this->faker->country,
            'contact' => $this->faker->email,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
