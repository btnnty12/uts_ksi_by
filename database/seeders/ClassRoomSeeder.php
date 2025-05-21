<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Services\ActivityLogger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'Kelas 1A',
            'Kelas 1B',
            'Kelas 2A',
            'Kelas 2B',
            'Kelas 3A',
            'Kelas 3B',
            'Kelas 4A',
            'Kelas 4B',
            'Kelas 5A',
            'Kelas 5B',
            'Kelas 6A',
            'Kelas 6B',
        ];

        foreach ($classes as $className) {
            $class = ClassRoom::create([
                'name' => $className,
            ]);
            
            // Log activity if ActivityLogger service is available
            try {
                ActivityLogger::log('create', 'classes', $class->id);
            } catch (\Throwable $th) {
                // Silently ignore if ActivityLogger can't be used during seeding
            }
        }
    }
}
