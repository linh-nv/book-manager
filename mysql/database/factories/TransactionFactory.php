<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first();
        $user = $order->user;

        return [
            'order_id' => Order::factory(), 
            'user_id' => User::factory(),
            'transaction_code' => $this->faker->unique()->uuid,
            'transaction_date' => now(),
        ];
    }
}
