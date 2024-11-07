<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Masum Ahmed',
            'email' => 'admin@genex.com',
            'password' => Hash::make('password'),
            'role' => User::ADMIN,
        ]);
    
        User::create([
            'name' => 'Shahidul',
            'email' => 'dev1@genex.com',
            'password' => Hash::make('password'),
            'role' => User::DEVELOPER,
        ]);

        User::create([
            'name' => 'Tuhin',
            'email' => 'dev2@genex.com',
            'password' => Hash::make('password'),
            'role' => User::DEVELOPER,
        ]);

        User::create([
            'name' => 'Sumon',
            'email' => 'dev3@genex.com',
            'password' => Hash::make('password'),
            'role' => User::DEVELOPER,
        ]);
    
        User::create([
            'name' => 'Zaman',
            'email' => 'user1@genex.com',
            'password' => Hash::make('password'),
            'role' => User::USER,
        ]);
        User::create([
            'name' => 'Rakim',
            'email' => 'user2@genex.com',
            'password' => Hash::make('password'),
            'role' => User::USER,
        ]);
    }
}
