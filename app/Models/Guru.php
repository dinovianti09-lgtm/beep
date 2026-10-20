<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'user_id',
        'nip',
        'nama_guru',
        'mapel_diampu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kelasDiajar()
    {
        return $this->belongsToMany(
            Kelas::class,
            'guru_kelas',
            'id_guru',
            'id_kelas',
            'id_guru',
            'id'
        );
    }
}