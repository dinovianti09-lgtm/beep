<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class NilaiApiAccessTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Gunakan database sementara, bukan database utama.
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => false,
        ]);

        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('status')->default('aktif');
            $table->boolean('must_change_password')->default(false);
            $table->timestamps();
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->unsignedBigInteger('user_id');
            $table->string('nis');
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->timestamps();
        });

        Schema::create('mapel', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->string('nama_mapel');
            $table->integer('kkm')->nullable();
            $table->timestamps();
        });

        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_rapor')->nullable();
            $table->decimal('nilai_harian', 5, 2)->nullable();
            $table->decimal('nilai_uts', 5, 2)->nullable();
            $table->decimal('nilai_uas', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->string('predikat')->nullable();
            $table->integer('semester')->default(1);
            $table->string('status_persetujuan')->default('pending');
            $table->timestamps();
        });
    }

    public function test_siswa_hanya_melihat_remedial_published_miliknya(): void
    {
        $user = User::create([
            'username' => 'siswa-test',
            'password' => bcrypt('password123'),
            'role' => 'siswa',
            'status' => 'aktif',
        ]);

        $siswaId = DB::table('siswa')->insertGetId([
            'user_id' => $user->id,
            'nis' => 'TEST001',
            'nama_siswa' => 'Siswa Pengujian',
            'kelas' => 'XII RPL 5',
        ]);

        $siswaLainId = DB::table('siswa')->insertGetId([
            'user_id' => 999,
            'nis' => 'TEST002',
            'nama_siswa' => 'Siswa Lain',
            'kelas' => 'XII RPL 5',
        ]);

        $mapelId = DB::table('mapel')->insertGetId([
            'nama_mapel' => 'Matematika',
            'kkm' => 75,
        ]);

        $dataNilai = [
            [
                'id_siswa' => $siswaId,
                'id_mapel' => $mapelId,
                'nilai_akhir' => 70,
                'status_persetujuan' => 'pending',
            ],
            [
                'id_siswa' => $siswaId,
                'id_mapel' => $mapelId,
                'nilai_akhir' => 85,
                'status_persetujuan' => 'published',
            ],
            [
                'id_siswa' => $siswaId,
                'id_mapel' => $mapelId,
                'nilai_akhir' => 65,
                'status_persetujuan' => 'published',
            ],
            [
                'id_siswa' => $siswaLainId,
                'id_mapel' => $mapelId,
                'nilai_akhir' => 60,
                'status_persetujuan' => 'published',
            ],
        ];

        $idNilai = [];

        foreach ($dataNilai as $nilai) {
            $idNilai[] = DB::table('nilai')->insertGetId($nilai);
        }

        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/nilai');

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id_nilai', $idNilai[2]);

        // Pending, tuntas, dan nilai siswa lain harus ditolak.
        foreach ([0, 1, 3] as $index) {
            $this->getJson('/api/nilai/' . $idNilai[$index])
                ->assertNotFound();
        }

        // Remedial published milik sendiri boleh diakses.
        $this->getJson('/api/nilai/' . $idNilai[2])
            ->assertOk()
            ->assertJsonPath('data.nilai_akhir', 65);
    }
}
