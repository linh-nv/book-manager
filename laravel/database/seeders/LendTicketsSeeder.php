<?php

namespace Database\Seeders;

use App\Models\LendTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LendTicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LendTicket::factory()->count(10)->create();
    }
}
