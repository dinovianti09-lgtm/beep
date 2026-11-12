<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaporSiswa extends Model
{
    protected $table = 'rapor_siswa';

    protected $primaryKey = 'id_rapor_siswa';

    protected $fillable = [
        'tgl_cetak',
        'file_pdf',
        'id_siswa',
        'id_rapor',
    ];

    protected $casts = [
        'tgl_cetak' => 'datetime',
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