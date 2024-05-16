<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 1, 
            'total_amount' => 100.00,
            'status' => 1,
        ]);

        Order::create([
            'user_id' => 2,
            'total_amount' => 150.00,
            'status' => 0,
        ]);

    }
}
