<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'slug' => $this->faker->unique()->slug(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->paragraph(),
            'front_image' => $this->faker->imageUrl(),
            'thumbnail' => $this->faker->imageUrl(),
            'rear_image' => $this->faker->imageUrl(),
            'category_id' => \App\Models\Category::factory(),
            'author_id' => \App\Models\Author::factory(),
            'publisher_id' => \App\Models\Publisher::factory(),
            'price' => $this->faker->numberBetween(100, 1000),
            'created_at' => $this->faker->dateTimeBetween('year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('year', 'now'),
        ];
    }
}
