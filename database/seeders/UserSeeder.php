<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Change this if you have a separate Admin model
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Prevent duplicates
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'), // Secure password
                'role' => 'admin', 
            ]
        );

        echo "Admin user seeded successfully!\n";
    }
}
