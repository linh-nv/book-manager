<?php

namespace Database\Seeders;

use App\Models\CouponUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CouponUser::create([
            'coupon_id' => '1',
            'user_id' => '1',
        ]);
        CouponUser::create([
            'coupon_id' => '2',
            'user_id' => '2',
        ]);
    }
}
