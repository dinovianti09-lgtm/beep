<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Masukkan Data User
        DB::table('user')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'guru1',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'siswa1',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Masukkan Data Guru
        DB::table('guru')->insert([
            'id_user' => 2,
            'nip' => '198501012010011001',
            'nama_guru' => 'Bapak Guru RPL',
            'no_hp' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Masukkan Data Siswa
        DB::table('siswa')->insert([
            'id_user' => 3,
            'nisn' => '0051234567',
            'nama_siswa' => 'Dina Novianti',
            'kelas' => 'XI RPL',
            'jenis_kelamin' => 'P',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}