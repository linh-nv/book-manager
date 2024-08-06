<?php

namespace Database\Seeders;

use App\Models\NewsImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsImages::factory()->count(50)->create();
    }
}
