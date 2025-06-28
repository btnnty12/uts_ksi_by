<?php

namespace App\Console\Commands;

use App\Models\Murids;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\EncryptionHelper;

class EncryptNisnCommand extends Command
{
    protected $signature = 'murids:encrypt-nisn';
    protected $description = 'Encrypt all NISN data in murids table';

    public function handle()
    {
        $this->info('Starting NISN encryption process...');
        
        // Ambil semua data murid
        $murids = DB::table('murids')->get();
        $count = 0;
        $skipped = 0;

        foreach ($murids as $murid) {
            // Skip jika NISN kosong
            if (empty($murid->nisn)) {
                $this->line("Skipping ID {$murid->id} - NISN is empty");
                $skipped++;
                continue;
            }

            // Skip jika NISN sudah memiliki prefix encrypted:
            if (str_starts_with($murid->nisn, 'encrypted:')) {
                $this->line("Skipping ID {$murid->id} - NISN already encrypted");
                $skipped++;
                continue;
            }

            try {
                // Enkripsi NISN
                $encrypted = EncryptionHelper::encrypt($murid->nisn);
                
                // Update di database
                DB::table('murids')
                    ->where('id', $murid->id)
                    ->update(['nisn' => $encrypted]);

                $this->info("Encrypted NISN for ID {$murid->id}");
                $count++;
            } catch (\Exception $e) {
                $this->error("Failed to encrypt NISN for ID {$murid->id}: {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info("Encryption process completed!");
        $this->info("Total records processed: " . count($murids));
        $this->info("Successfully encrypted: {$count}");
        $this->info("Skipped (already encrypted/empty): {$skipped}");
        $this->info("Failed: " . (count($murids) - $count - $skipped));
    }
} 