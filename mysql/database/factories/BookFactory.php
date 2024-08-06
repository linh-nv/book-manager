<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $title = $this->faker->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => $this->faker->numberBetween(0, 1),
            'category_id' => Category::inRandomOrder()->first()->id,
            'publisher_id' => Publisher::inRandomOrder()->first()->id,
            'regular_price' => $this->faker->randomFloat(4, 10, 100),
            'sale_price' => $this->faker->optional()->randomFloat(4, 5, 50),
            'discount_percentage' => $this->faker->numberBetween(0, 100),
            'publication_date' => $this->faker->optional()->date(),
            'language' => $this->faker->optional()->languageCode,
            'pages' => $this->faker->optional()->numberBetween(100, 1000),
            'description' => $this->faker->optional()->paragraph,
            'image_url' => $this->faker->optional()->imageUrl,
            'rating' => $this->faker->randomFloat(2, 0, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
