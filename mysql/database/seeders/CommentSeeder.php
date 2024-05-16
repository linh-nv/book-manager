<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'user_id' => '1',
            'book_id' => '1',
            'content' => 'Sách hay',
            'rating' => random_int(1, 5),
        ]);
        Comment::create([
            'user_id' => '2',
            'book_id' => '1',
            'content' => 'Sách không hay',
            'rating' => random_int(1, 5),
        ]);
        Comment::create([
            'user_id' => '3',
            'book_id' => '1',
            'content' => 'Sách cũng được',
            'rating' => random_int(1, 5),
        ]);
    }
}
