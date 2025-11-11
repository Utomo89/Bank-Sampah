<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seeding user with role admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@banksampah.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // seeding user with role user
        User::create([
            'name' => 'User',
            'email' => 'user@banksampah.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
