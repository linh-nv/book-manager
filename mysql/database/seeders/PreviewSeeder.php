<?php

namespace Database\Seeders;

use App\Models\Preview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Preview::create([
            'book_id' => '1',
            'cover_image_url' => 'preview.jpg',
            'preview_content' => 'preview sachs ',
        ]);
    }
}
