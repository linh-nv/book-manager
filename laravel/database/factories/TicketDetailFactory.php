<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\LendTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketDetail>
 */
class TicketDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::factory(),
            'lend_ticket_id' => LendTicket::factory(),
            'return_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'status' => $this->faker->numberBetween(0, 4),
            'quantity' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween('year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('year', 'now'),
        ];
    }
}
