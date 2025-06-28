<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::create([
            'nama_kelas' => 'Kelas 10 IPA 1',
            'walikelas_id' => 1,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas 10 IPA 2',
            'walikelas_id' => 2, 
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas 11 IPS 1',
            'walikelas_id' => 3, 
        ]);
    }
}
