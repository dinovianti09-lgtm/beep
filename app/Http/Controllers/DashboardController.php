<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // =========================
    // DASHBOARD ADMIN
    // =========================

    public function index()
    {
        $user = Auth::user();

        $jumlahGuru = Guru::count();
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahMapel = Mapel::count();

        $guruList = Guru::orderBy('id_guru', 'desc')
            ->take(5)
            ->get();

        $siswaList = Siswa::orderBy('id_siswa', 'desc')
            ->take(5)
            ->get();

        // Data tambahan yang dipakai dashboard Admin
        $namaSiswa = $user->username ?? 'Admin';

        $inisial = strtoupper(
            substr($namaSiswa, 0, 2)
        );

        // Rata-rata semua nilai
        $avgNilai = Nilai::avg('nilai_akhir') ?? 0;

        // Jumlah mata pelajaran yang sudah memiliki nilai
        $totalMapelDinilai = Nilai::distinct('id_mapel')
            ->count('id_mapel');

        // 5 nilai terbaru untuk dashboard Admin
        $nilaiTerbaru = Nilai::with([
            'siswa',
            'mapel'
        ])
            ->orderBy('id_nilai', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'jumlahGuru',
            'jumlahSiswa',
            'jumlahKelas',
            'jumlahMapel',
            'guruList',
            'siswaList',
            'namaSiswa',
            'inisial',
            'avgNilai',
            'totalMapelDinilai',
            'nilaiTerbaru'
        ));
    }


    // =========================
    // DASHBOARD GURU
    // =========================

    public function guru()
    {
        $user = Auth::user();

        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            Auth::logout();

            return redirect()
                ->route('login')
                ->withErrors([
                    'username' => 'Data Guru untuk akun ini belum ditemukan.',
                ]);
        }

        $kelasWali = Kelas::where(
            'wali_kelas',
            $guru->nama_guru
        )->first();

        $siswaWali = collect();

        if ($kelasWali) {
            $namaKelas = str_replace(
                '-',
                ' ',
                $kelasWali->nama_kelas
            );

            $siswaWali = Siswa::whereRaw(
                "REPLACE(kelas, '-', ' ') = ?",
                [$namaKelas]
            )
                ->orderBy('nama_siswa')
                ->get();
        }

        $jumlahSiswaWali = $siswaWali->count();

        return view('guru.dashboard', compact(
            'guru',
            'kelasWali',
            'siswaWali',
            'jumlahSiswaWali'
        ));
    }


    // =========================
    // DASHBOARD SISWA
    // =========================

    public function siswa()
    {
        $user = Auth::user();

        $siswa = Siswa::where(
            'user_id',
            $user->id
        )->first();

        $semesterTerpilih = request(
            'semester',
            ''
        );

        if (!$siswa) {
            return view('siswa.dashboard', [
                'siswa' => null,
                'namaSiswa' => $user->username,
                'inisial' => strtoupper(
                    substr(
                        $user->username,
                        0,
                        2
                    )
                ),
                'nilaiTerbaru' => collect(),
                'avgNilai' => 0,
                'totalMapelDinilai' => 0,
                'semesterTerpilih' => $semesterTerpilih,
            ]);
        }

        $queryNilai = Nilai::with('mapel')
            ->where(
                'id_siswa',
                $siswa->id_siswa
            );

        if (
            in_array(
                $semesterTerpilih,
                ['1', '2']
            )
        ) {
            $queryNilai->where(
                'semester',
                $semesterTerpilih
            );
        }

        $nilaiTerbaru = (clone $queryNilai)
            ->orderBy(
                'id_nilai',
                'desc'
            )
            ->take(5)
            ->get();

        $avgNilai = (clone $queryNilai)
            ->avg('nilai_akhir');

        $avgNilai = $avgNilai ?? 0;

        $totalMapelDinilai = (clone $queryNilai)
            ->distinct('id_mapel')
            ->count('id_mapel');

        $namaSiswa = $siswa->nama_siswa;

        $inisial = strtoupper(
            substr(
                $namaSiswa,
                0,
                2
            )
        );

        return view('siswa.dashboard', compact(
            'siswa',
            'namaSiswa',
            'inisial',
            'nilaiTerbaru',
            'avgNilai',
            'totalMapelDinilai',
            'semesterTerpilih'
        ));
    }
}