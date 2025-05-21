<?php

namespace Database\Seeders;

use App\Models\NoteAct;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteActSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            return;
        }
        
        $faker = Factory::create();
        
        // Action types
        $actions = ['create', 'update', 'delete', 'view'];
        
        // Tables that might be logged
        $tables = ['users', 'classes', 'students'];
        
        // Create 50 random activity logs
        for ($i = 0; $i < 50; $i++) {
            $user = $users->random();
            $action = $faker->randomElement($actions);
            $table = $faker->randomElement($tables);
            $recordId = $faker->randomNumber(3, true);
            
            // Create activity log entry with a timestamp within the last 30 days
            NoteAct::create([
                'user_id' => $user->id,
                'action' => $action,
                'table_name' => $table,
                'record_id' => $recordId,
                'created_at' => $faker->dateTimeBetween('-30 days', 'now'),
                'updated_at' => $faker->dateTimeBetween('-30 days', 'now'),
            ]);
        }
    }
}
