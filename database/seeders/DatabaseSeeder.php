<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'guru1',
                'password' => Hash::make('guru123'),
                'role' => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'siswa1',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Guru
        DB::table('guru')->insert([
            [
                'id_user' => 2,
                'nip' => '198501012010011001',
                'nama_guru' => 'Bapak Guru RPL',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Siswa
        DB::table('siswa')->insert([
            [
                'id_user' => 3,
                'nisn' => '0051234567',
                'nama_siswa' => 'Dina Novianti',
                'kelas' => 'XI RPL',
                'jenis_kelamin' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Mapel
        DB::table('mapel')->insert([
            [
                'kode_mapel' => 'RPL001',
                'nama_mapel' => 'Pemrograman Web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mapel' => 'RPL002',
                'nama_mapel' => 'Basis Data',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Kelas
        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'X RPL 1',
                'tingkat' => 'X',
                'jurusan' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XI RPL 1',
                'tingkat' => 'XI',
                'jurusan' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'XII RPL 1',
                'tingkat' => 'XII',
                'jurusan' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}