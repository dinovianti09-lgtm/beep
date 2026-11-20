<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RaporApprovalTest extends TestCase
{
    private int $raporSiswaId;
    private int $nilaiId;

    protected function setUp(): void
    {
        parent::setUp();

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

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->string('tingkat');
            $table->string('jurusan')->nullable();
            $table->string('wali_kelas')->nullable();
            $table->timestamps();
        });

        Schema::create('mapel', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->string('nama_mapel');
            $table->integer('kkm')->nullable();
            $table->timestamps();
        });

        Schema::create('mapel_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mapel');
            $table->string('jurusan');
            $table->string('tingkat');
            $table->timestamps();
        });

        Schema::create('rapor', function (Blueprint $table) {
            $table->id('id_rapor');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->timestamps();
        });

        Schema::create('rapor_siswa', function (Blueprint $table) {
            $table->id('id_rapor_siswa');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_rapor');
            $table->dateTime('tgl_cetak')->nullable();
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });

        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_rapor');
            $table->decimal('nilai_harian', 5, 2)->nullable();
            $table->decimal('nilai_uts', 5, 2)->nullable();
            $table->decimal('nilai_uas', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->string('status_persetujuan')->default('pending');
            $table->timestamps();
        });

        $admin = User::create([
            'username' => 'admin-test',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $this->actingAs($admin);

        $siswaId = DB::table('siswa')->insertGetId([
            'user_id' => 999,
            'nis' => 'TEST001',
            'nama_siswa' => 'Siswa Pengujian',
            'kelas' => 'XII RPL 5',
        ]);

        DB::table('kelas')->insert([
            'nama_kelas' => 'XII RPL 5',
            'tingkat' => 'XII',
            'jurusan' => 'RPL',
        ]);

        $mapelId = DB::table('mapel')->insertGetId([
            'nama_mapel' => 'Matematika',
            'kkm' => 75,
        ]);

        DB::table('mapel_kelas')->insert([
            'id_mapel' => $mapelId,
            'jurusan' => 'RPL',
            'tingkat' => 'XII',
        ]);

        $raporId = DB::table('rapor')->insertGetId([
            'semester' => '1',
            'tahun_ajaran' => '2026/2027',
        ]);

        $this->raporSiswaId = DB::table('rapor_siswa')->insertGetId([
            'id_siswa' => $siswaId,
            'id_rapor' => $raporId,
        ]);

        $this->nilaiId = DB::table('nilai')->insertGetId([
            'id_siswa' => $siswaId,
            'id_mapel' => $mapelId,
            'id_rapor' => $raporId,
            'nilai_harian' => 80,
            'nilai_uts' => 80,
            'nilai_uas' => 80,
            'nilai_akhir' => 80,
            'status_persetujuan' => 'pending',
        ]);
    }

    public function test_nilai_pending_tidak_bisa_dicetak(): void
    {
        $this->post(route(
            'admin.rapor_siswa.cetak',
            $this->raporSiswaId
        ))->assertRedirect();

        $this->assertDatabaseHas('rapor_siswa', [
            'id_rapor_siswa' => $this->raporSiswaId,
            'tgl_cetak' => null,
        ]);
    }

    public function test_nilai_published_bisa_dicetak(): void
    {
        DB::table('nilai')
            ->where('id_nilai', $this->nilaiId)
            ->update([
                'status_persetujuan' => 'published',
            ]);

        $this->post(route(
            'admin.rapor_siswa.cetak',
            $this->raporSiswaId
        ))->assertRedirect(route(
            'admin.rapor_siswa.show',
            $this->raporSiswaId
        ));

        $this->assertNotNull(
            DB::table('rapor_siswa')
                ->where('id_rapor_siswa', $this->raporSiswaId)
                ->value('tgl_cetak')
        );
    }
}
