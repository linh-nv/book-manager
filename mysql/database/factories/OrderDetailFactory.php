<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book = Book::inRandomOrder()->first();
        
        return [
            'order_id' => Order::factory(),
            'book_id' => $book->id,
            'book_name' => $book->title,
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $book->sale_price ?? $book->regular_price,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
