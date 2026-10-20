<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan',
        'wali_kelas',
    ];

    public function guruDiajar()
    {
        return $this->belongsToMany(
            Guru::class,
            'guru_kelas',
            'id_kelas',
            'id_guru',
            'id',
            'id_guru'
        );
    }
}