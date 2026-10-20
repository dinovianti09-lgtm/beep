<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    protected $table = 'mapel';

    protected $primaryKey = 'id_mapel';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nama_mapel',
        'kkm',
    ];

    protected function casts(): array
    {
        return [
            'kkm' => 'integer',
        ];
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(
            Nilai::class,
            'id_mapel',
            'id_mapel'
        );
    }

    public function pengaturanKelas(): HasMany
    {
        return $this->hasMany(
            MapelKelas::class,
            'id_mapel',
            'id_mapel'
        );
    }
}
