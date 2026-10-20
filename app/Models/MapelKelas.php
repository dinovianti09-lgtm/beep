<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MapelKelas extends Model
{
    protected $table = 'mapel_kelas';

    protected $fillable = [
        'id_mapel',
        'jurusan',
        'tingkat',
    ];

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(
            Mapel::class,
            'id_mapel',
            'id_mapel'
        );
    }
}
