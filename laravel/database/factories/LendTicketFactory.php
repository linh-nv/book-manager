<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LendTicket>
 */
class LendTicketFactory extends Factory
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
            'start_date' => $this->faker->dateTimeBetween('year', 'now')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'status' => $this->faker->numberBetween(0, 3),
            'note' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeBetween('year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('year', 'now'),
        ];
    }
}
