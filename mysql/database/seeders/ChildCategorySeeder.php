<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChildCategory::create([
            'category_id' => 1, 
            'name' => 'Child Category 1',
            'slug' => Str::slug('Child Category 1'),
            'description' => 'Description of Child Category 1',
        ]);

        ChildCategory::create([
            'category_id' => 2, 
            'name' => 'Child Category 2',
            'slug' => Str::slug('Child Category 2'),
            'description' => 'Description of Child Category 2',
        ]);
    }
}
