<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->lexify('??????'),
            'description' => $this->faker->text,
            'discount' => $this->faker->randomFloat(2, 1, 50),
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'usage_limit' => $this->faker->numberBetween(1, 100),
            'used_count' => 0,
        ];
    }
}
