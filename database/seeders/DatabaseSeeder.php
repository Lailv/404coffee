<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Lail',
            'email' => 'lail@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Nazala',
            'email' => 'nazala@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'kasir'
        ]);

        User::create([
            'name' => 'Ridha',
            'email' => 'ridha@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'kasir'
        ]);

        User::create([
            'name' => 'Wahyu',
            'email' => 'wahyu@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'kasir'
        ]);
    }
}