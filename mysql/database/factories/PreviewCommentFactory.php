<?php

namespace Database\Factories;

use App\Models\Preview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PreviewComment>
 */
class PreviewCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'preview_id' => Preview::factory(),
            'content' => $this->faker->paragraph,
            'rating' => $this->faker->randomFloat(2, 1, 5),
        ];
    }
}
