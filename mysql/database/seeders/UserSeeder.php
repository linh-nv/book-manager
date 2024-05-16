<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 0,
            'phone' => '0123456789',
            'address' => '123 Admin St.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'username' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password'),
            'role' => 1,
            'phone' => '0123456789',
            'address' => '123 user1 St.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'username' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 1,
            'phone' => '0123456789',
            'address' => '123 user2 St.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
