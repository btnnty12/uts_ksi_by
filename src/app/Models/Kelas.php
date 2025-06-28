<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'walikelas_id',
    ];

    public function walikelas()
    {
        return $this->belongsTo(User::class, 'walikelas_id');
    }
}
