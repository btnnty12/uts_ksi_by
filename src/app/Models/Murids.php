<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\EncryptionHelper;

class Murids extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nisn',
        'kelas_id',
        'tanggal_lahir',
    ];

    // Pastikan field nisn selalu melalui accessor/mutator
    protected $casts = [
        'tanggal_lahir' => 'date',
        'nisn' => 'encrypted',
    ];

    // Enkripsi nisn saat disimpan ke database
    protected function setNisnAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['nisn'] = EncryptionHelper::encrypt($value);
        }
    }

    // Dekripsi nisn saat diambil dari database
    protected function getNisnAttribute($value)
    {
        if (!empty($value)) {
            try {
                return EncryptionHelper::decrypt($value);
            } catch (\Exception $e) {
                return $value; // Return original if can't decrypt
            }
        }
        return $value;
    }
}
