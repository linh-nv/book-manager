<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\LendTicket;
use App\Models\Role;
use App\Models\TicketDetail;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    
        Category::factory()->count(5)->create();
        Author::factory()->count(5)->create();
        Publisher::factory()->count(5)->create();
        Book::factory()->count(5)->create();
        LendTicket::factory()->count(5)->create();
        TicketDetail::factory()->count(5)->create();
    }
    
}
