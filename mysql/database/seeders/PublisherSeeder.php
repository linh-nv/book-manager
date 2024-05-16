<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publisher::create([
            'name' => 'Publisher 1',
            'address' => '123 Street, City, Country',
            'contact' => 'publisher1@linh.com',
        ]);

        Publisher::create([
            'name' => 'Publisher 2',
            'address' => '456 Avenue, Town, Country',
            'contact' => 'publisher2@linh.com',
        ]);

    }
}
