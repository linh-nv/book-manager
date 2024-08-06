<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_code' => 'AD01',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role_id' => '1',
            'password' => Hash::make('12345678'),
            'address' => 'Đông Anh - Hà Nội',
            'tel' => '0999999999',
            'birthday' => '2003-01-27',
            'gender' => 1,
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::factory()->count(10)->create();
    }
}
