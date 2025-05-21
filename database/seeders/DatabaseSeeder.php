<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First create users
        $this->call(AdminUserSeeder::class);
        
        // Then create classes
        $this->call(ClassRoomSeeder::class);
        
        // Then create students (which depend on users and classes)
        $this->call(StudentSeeder::class);
        
        // Finally create activity logs (which depend on users)
        $this->call(NoteActSeeder::class);
    }
}
