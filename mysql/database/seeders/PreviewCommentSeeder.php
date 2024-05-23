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
        PreviewComment::factory(10)->create();
    }
}
