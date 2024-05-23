<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\Book;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => Cart::inRandomOrder()->first()->id,
            'books_id' => Book::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 10),
            'added_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
