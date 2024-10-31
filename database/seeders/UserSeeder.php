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
            'name' => 'Admin User',
            'email' => 'admin@genex.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);
    
        User::create([
            'name' => 'Developer User',
            'email' => 'developer@genex.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_DEV,
        ]);
    
        User::create([
            'name' => 'Regular User',
            'email' => 'user@genex.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_USER,
        ]);
    }
}
