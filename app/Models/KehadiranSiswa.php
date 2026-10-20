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
}
