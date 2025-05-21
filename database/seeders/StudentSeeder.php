<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use App\Services\ActivityLogger;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user for created_by field
        $adminUser = User::where('role', 'admin')->first();
        
        if (!$adminUser) {
            // If admin user doesn't exist, get any user
            $adminUser = User::first();
            
            if (!$adminUser) {
                // If no users exist, we can't proceed
                return;
            }
        }
        
        // Get all classes
        $classes = ClassRoom::all();
        
        if ($classes->isEmpty()) {
            // If no classes exist, we can't proceed
            return;
        }
        
        // Create faker instance
        $faker = Factory::create('id_ID'); // Indonesian locale
        
        // Generate 5-10 students for each class
        foreach ($classes as $class) {
            $studentCount = rand(5, 10);
            
            for ($i = 0; $i < $studentCount; $i++) {
                $gender = $faker->randomElement(['male', 'female']);
                $firstName = $faker->firstName($gender);
                $lastName = $faker->lastName();
                $fullName = $firstName . ' ' . $lastName;
                
                // Generate realistic NISN (10 digits)
                $nisn = date('y') . str_pad(rand(1, 9999), 8, '0', STR_PAD_LEFT);
                
                $student = Student::create([
                    'name' => $fullName,
                    'nisn' => $nisn,
                    'class_id' => $class->id,
                    'birth_date' => $faker->dateTimeBetween('-18 years', '-6 years'),
                    'address' => $faker->address(),
                    'created_by' => $adminUser->id,
                ]);
                
                // Log activity if ActivityLogger service is available
                try {
                    ActivityLogger::log('create', 'students', $student->id);
                } catch (\Throwable $th) {
                    // Silently ignore if ActivityLogger can't be used during seeding
                }
            }
        }
    }
}
