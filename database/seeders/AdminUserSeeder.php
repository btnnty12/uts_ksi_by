<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // Create operator user if it doesn't exist
        if (!User::where('email', 'operator@example.com')->exists()) {
            User::create([
                'name' => 'Operator',
                'email' => 'operator@example.com',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'email_verified_at' => now(),
            ]);
        }
        
        // Create student user if it doesn't exist
        if (!User::where('email', 'student@example.com')->exists()) {
            User::create([
                'name' => 'Student User',
                'email' => 'student@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]);
        }
    }
}
