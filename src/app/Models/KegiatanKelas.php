<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KegiatanKelas extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_kelas';

    protected $fillable = [
        'murid_id',
        'guru_id',
        'tanggal',
        'keterangan',
        'kehadiran',
        'sikap',
        'catatan_tugas',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the murid that owns the kegiatan.
     */
    public function murid(): BelongsTo
    {
        return $this->belongsTo(Murids::class, 'murid_id');
    }

    /**
     * Get the guru that owns the kegiatan.
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
