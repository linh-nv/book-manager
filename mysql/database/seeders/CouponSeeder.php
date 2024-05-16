<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'code' => '111111',
            'description' => 'Khuyến mãi ngày 01/01',
            'discount' => random_int(10,90),
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'usage_limit' => random_int(1, 100),
            'used_count' => 0,
        ]);
        Coupon::create([
            'code' => '222222',
            'description' => 'Khuyến mãi ngày 02/02',
            'discount' => random_int(10,90),
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'usage_limit' => random_int(1, 100),
            'used_count' => 0,
        ]);
        Coupon::create([
            'code' => '333333',
            'description' => 'Khuyến mãi ngày 03/03',
            'discount' => random_int(10,90),
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'usage_limit' => random_int(1, 100),
            'used_count' => 0,
        ]);
    }
}
