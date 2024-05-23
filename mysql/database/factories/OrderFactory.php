<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\CouponUser;
use App\Models\Admin;
use App\Models\City;
use App\Models\District;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'user_address_id' => Address::factory(),
            'coupon_user_id' => CouponUser::inRandomOrder()->first()?->id,
            'admin_id' => Admin::inRandomOrder()->first()?->id,
            'name' => $this->faker->name,
            'email' => $this->faker->optional()->safeEmail,
            'phone' => $this->faker->optional()->phoneNumber,
            'address' => $this->faker->address,
            'province_id' => City::factory(),
            'district_id' => District::factory(),
            'ward_id' => Commune::factory(),
            'price_sale_off' => $this->faker->randomFloat(4, 0, 100),
            'shipping_fee' => $this->faker->randomFloat(4, 0, 20),
            'total_money' => $this->faker->randomFloat(4, 20, 200),
            'paid_at' => $this->faker->optional()->dateTime,
            'canceled_at' => $this->faker->optional()->dateTime,
            'payment_type' => $this->faker->optional()->numberBetween(0, 2),
            'status' => $this->faker->numberBetween(0, 5), // Assuming 0-5 are possible statuses
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
