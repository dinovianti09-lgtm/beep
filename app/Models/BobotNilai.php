<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotNilai extends Model
{
    protected $table = 'bobot_nilai';

    protected $primaryKey = 'id_bobot';

    protected $fillable = [
        'id_mapel',
        'id_rapor',
        'bobot_harian',
        'bobot_uts',
        'bobot_uas',
    ];

    protected $casts = [
        'id_mapel' => 'integer',
        'id_rapor' => 'integer',
        'bobot_harian' => 'integer',
        'bobot_uts' => 'integer',
        'bobot_uas' => 'integer',
    ];

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
