<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Publisher;
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
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'status' => $this->faker->numberBetween(0, 1),
            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
            'child_category_id' => ChildCategory::factory(),
            'regular_price' => $this->faker->randomFloat(2, 10, 100),
            'sale_price' => $this->faker->randomFloat(2, 5, 50),
            'publisher_id' => Publisher::factory(),
            'publication_date' => $this->faker->date,
            'language' => $this->faker->languageCode,
            'pages' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
