<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $primaryKey = 'id_nilai';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'id_rapor',
        'nilai_harian',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'predikat',
        'semester',
    ];

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'id_siswa',
            'id_siswa'
        );
    }

    public function mapel()
    {
        return $this->belongsTo(
            Mapel::class,
            'id_mapel',
            'id_mapel'
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