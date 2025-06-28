<?php

namespace Database\Seeders;

use App\Models\Murids;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MuridsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data to prevent duplicates on re-seeding
        Murids::truncate();

        // Seed 10 dummy murids
        for ($i = 0; $i < 10; $i++) {
            Murids::create([
                'nama' => fake()->name(),
                'nisn' => fake()->unique()->numerify('##########'), // 10 digits NISN
                'kelas_id' => fake()->numberBetween(1, 5), // Assuming 5 classes
                'tanggal_lahir' => fake()->date('Y-m-d', '2005-01-01'), // Example birth date
            ]);
        }
    }
}
