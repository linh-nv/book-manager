<?php

namespace Database\Seeders;

use App\Models\TicketDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketDetail::factory()->count(10)->create();
    }
}
