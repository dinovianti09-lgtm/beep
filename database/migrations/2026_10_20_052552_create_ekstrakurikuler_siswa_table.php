<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkstrakurikulerSiswa extends Model
{
    protected $table = 'ekstrakurikuler_siswa';

    protected $primaryKey = 'id_ekstrakurikuler_siswa';

    protected $fillable = [
        'id_siswa',
        'id_rapor',
        'nama_ekstrakurikuler',
        'predikat',
        'keterangan',
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
