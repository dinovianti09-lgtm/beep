<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'role',
        'status',
        'must_change_password',
        'activation_token_hash',
        'activation_expires_at',
        'activated_at',
    ];

    protected $hidden = [
        'password',
        'activation_token_hash',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'activation_expires_at' => 'datetime',
            'activated_at' => 'datetime',
            'must_change_password' => 'boolean',
        ];
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id', 'id');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }
}