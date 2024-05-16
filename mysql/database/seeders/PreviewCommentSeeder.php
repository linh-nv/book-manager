<?php

namespace Database\Seeders;

use App\Models\PreviewComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreviewCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PreviewComment::create([
            'user_id' => '1',
            'preview_id' => '1',
            'content' => 'Hữu ích',
            'rating' => random_int(1, 5),
        ]);
    }
}
