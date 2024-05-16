<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'Tin sách mới',
            'content' => 'Sách mới về hay lắm',
            'user_id' => '1',
            'published_at' => now(),
        ]);
    }
}
