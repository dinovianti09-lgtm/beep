<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    protected $table = 'rapor';

    protected $primaryKey = 'id_rapor';

    protected $fillable = [
        'semester',
        'tahun_ajaran',
    ];

    public function nilai()
    {
        return $this->hasMany(
            Nilai::class,
            'id_rapor',
            'id_rapor'
        );
    }

    public function raporSiswa()
    {
        return $this->hasMany(
            RaporSiswa::class,
            'id_rapor',
            'id_rapor'
        );
    }
}