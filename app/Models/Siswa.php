<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Nilai;
use App\Models\RaporSiswa;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'user_id',
        'nis',
        'nama_siswa',
        'kelas',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_siswa', 'id_siswa');
    }

    public function raporSiswa()
    {
        return $this->hasMany(RaporSiswa::class, 'id_siswa', 'id_siswa');
    }
}
