<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Linh',
            'contact' => 'linh@linh.com',
            'biography' => 'Biography of Linh',
            'birthdate' => '2003-01-01',
            'nationality' => 'VietNam',
        ]);

        Author::create([
            'name' => 'Phi',
            'contact' => 'phi@linh.com',
            'biography' => 'Biography of Phi',
            'birthdate' => '2003-05-15',
            'nationality' => 'American',
        ]);

        Author::create([
            'name' => 'Binh Nguyen',
            'contact' => 'binhnguyen@linh.com',
            'biography' => 'Biography of BinhNguyen',
            'birthdate' => '2003-06-16',
            'nationality' => 'Campuchia',
        ]);

        Author::create([
            'name' => 'Binh Duong',
            'contact' => 'binhduong@linh.com',
            'biography' => 'Biography of binh duong',
            'birthdate' => '2003-07-17',
            'nationality' => 'Indonesia',
        ]);

        Author::create([
            'name' => 'Hoa',
            'contact' => 'hoa@linh.com',
            'biography' => 'Biography of Hoa',
            'birthdate' => '2001-08-18',
            'nationality' => 'Laos',
        ]);
    }
}
