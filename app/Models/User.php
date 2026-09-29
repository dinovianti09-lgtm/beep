<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Menegaskan nama tabel di MySQL adalah 'users'
    protected $table = 'users';

    /**
     * Field yang boleh diisi (mass assignable).
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    /**
     * Field yang disembunyikan saat dikonversi ke array/JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data field.
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}