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
        // 1. Matikan pemeriksaan Foreign Key sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Kosongkan tabel users dengan aman
        DB::table('users')->truncate();

        // 3. Masukkan data akun baru
        DB::table('users')->insert([
            [
                'username'   => 'admin',
                'password'   => Hash::make('password'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'guru',
                'password'   => Hash::make('password'),
                'role'       => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'siswa',
                'password'   => Hash::make('password'),
                'role'       => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 4. Nyalakan kembali pemeriksaan Foreign Key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}