<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranSiswa extends Model
{
    protected $table = 'kehadiran_siswa';

    protected $primaryKey = 'id_kehadiran';

    protected $fillable = [
        'id_siswa',
        'id_rapor',
        'sakit',
        'izin',
        'tanpa_keterangan',
    ];

    protected $casts = [
        'sakit' => 'integer',
        'izin' => 'integer',
        'tanpa_keterangan' => 'integer',
    ];

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'id_siswa',
            'id_siswa'
        );
    }

    public function rapor()
    {
        return $this->belongsTo(
            Rapor::class,
            'id_rapor',
            'id_rapor'
        );
    }
}
