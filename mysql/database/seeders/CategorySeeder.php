<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Category 1',
            'slug' => Str::slug('Category 1'),
            'description' => 'Description of Category 1',
        ]);

        Category::create([
            'name' => 'Category 2',
            'slug' => Str::slug('Category 2'),
            'description' => 'Description of Category 2',
        ]);
    }
}
