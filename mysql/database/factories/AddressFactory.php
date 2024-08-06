<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Commune;
use App\Models\District;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
            'address' => $this->faker->address,
            'city_id' => City::factory(),
            'district_id' => District::factory(),
            'commune_id' => Commune::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
