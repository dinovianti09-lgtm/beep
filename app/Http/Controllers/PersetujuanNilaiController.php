<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersetujuanNilaiController extends Controller
{
    /**
     * Mengambil guru yang sedang login.
     */
    private function guruLogin(): Guru
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'guru',
            403
        );

        return Guru::where('user_id', auth()->id())
            ->firstOrFail();
    }

    /**
     * Mengambil kelas yang menjadi tanggung jawab wali kelas.
     */
    private function kelasWali(Guru $guru): Kelas
    {
        $kelas = Kelas::where('wali_kelas', $guru->nama_guru)
            ->first();

        abort_unless(
            $kelas !== null,
            403,
            'Anda bukan wali kelas yang terdaftar.'
        );

        return $kelas;
    }

    /**
     * Menyamakan format nama kelas.
     */
    private function namaKelas(Kelas $kelas): string
    {
        return strtolower(
            str_replace('-', ' ', trim($kelas->nama_kelas))
        );
    }

    /**
     * Menampilkan nilai yang menunggu persetujuan.
     */
    public function index()
    {
        $guru = $this->guruLogin();
        $kelas = $this->kelasWali($guru);
        $namaKelas = $this->namaKelas($kelas);

        $nilaiPending = Nilai::with(['siswa', 'mapel', 'rapor'])
            ->where('status_persetujuan', 'pending')
            ->whereHas('siswa', function ($query) use ($namaKelas) {
                $query->whereRaw(
                    "LOWER(REPLACE(TRIM(kelas), '-', ' ')) = ?",
                    [$namaKelas]
                );
            })
            ->orderBy('id_nilai')
            ->paginate(15);

        return view(
            'guru.persetujuan-nilai.index',
            compact('guru', 'kelas', 'nilaiPending')
        );
    }

    /**
     * Menyetujui satu nilai siswa.
     */
    public function setujui(Request $request, $id)
    {
        $guru = $this->guruLogin();
        $kelas = $this->kelasWali($guru);
        $namaKelas = $this->namaKelas($kelas);

        DB::transaction(function () use ($id, $guru, $namaKelas) {
            $nilai = Nilai::where('id_nilai', $id)
                ->where('status_persetujuan', 'pending')
                ->whereHas('siswa', function ($query) use ($namaKelas) {
                    $query->whereRaw(
                        "LOWER(REPLACE(TRIM(kelas), '-', ' ')) = ?",
                        [$namaKelas]
                    );
                })
                ->lockForUpdate()
                ->firstOrFail();

            $nilai->status_persetujuan = 'published';
            $nilai->disetujui_oleh = $guru->id_guru;
            $nilai->disetujui_pada = now();

            $nilai->save();
        });

        return redirect()
            ->route('guru.persetujuan-nilai.index')
            ->with(
                'success',
                'Nilai berhasil disetujui oleh wali kelas.'
            );
    }
}