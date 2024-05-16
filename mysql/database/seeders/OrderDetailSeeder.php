<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderDetail;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetail::create([
            'order_id' => 1,
            'book_id' => 1,
            'quantity' => 2,
            'unit_price' => 20.99,
        ]);

        OrderDetail::create([
            'order_id' => 2, 
            'book_id' => 2, 
            'quantity' => 10,
            'unit_price' => 15.99,
        ]);

    }
}
