<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'title' => 'Book 1',
            'slug' => Str::slug('Book 1'),
            'status' => 1,
            'author_id' => 1, 
            'category_id' => 1,
            'child_category_id' => 1,
            'regular_price' => 20.99,
            'sale_price' => 15.99,
            'publisher_id' => 1, 
            'publication_date' => '2023-01-01',
            'language' => 'English',
            'pages' => 300,
            'description' => 'Description of Book 1',
            'image_url' => 'book1.jpg',
        ]);

        Book::create([
            'title' => 'Book 2',
            'slug' => Str::slug('Book 2'),
            'status' => 0, 
            'author_id' => 2, 
            'category_id' => 2, 
            'child_category_id' => 2, 
            'regular_price' => 25.99,
            'sale_price' => 20.99,
            'publisher_id' => 2, 
            'publication_date' => '2023-02-01',
            'language' => 'French',
            'pages' => 250,
            'description' => 'Description of Book 2',
            'image_url' => 'book2.jpg',
        ]);
    }
}
