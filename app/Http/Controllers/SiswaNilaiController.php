<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Rapor;
use App\Models\RaporSiswa;
use App\Models\Kelas;
use App\Models\MapelKelas;
use Illuminate\Support\Facades\Auth;

class SiswaNilaiController extends Controller
{
    /**
     * Menampilkan nilai siswa, termasuk mapel yang belum diinput.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $siswa = Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()
                ->route('siswa.dashboard')
                ->with('error', 'Data siswa belum terhubung dengan akun ini.');
        }

        // Ambil seluruh periode rapor.
        $semesterList = Rapor::orderByDesc('id_rapor')->get();

        $semesterDipilih = request('semester');

        $periodeTersedia = $semesterList->contains(
            fn ($rapor) =>
                (string) $rapor->id_rapor === (string) $semesterDipilih
        );

        if (!$periodeTersedia) {
            $semesterDipilih = $semesterList->isNotEmpty()
                ? (string) $semesterList->first()->id_rapor
                : null;
        }

        $periodeAktif = $semesterDipilih !== null
            ? $semesterList->first(
                fn ($rapor) =>
                    (string) $rapor->id_rapor === (string) $semesterDipilih
            )
            : null;

        // Ambil jurusan dan tingkat dari nama kelas siswa.
        $bagianKelas = preg_split(
            '/\s+/',
            trim(str_replace('-', ' ', $siswa->kelas ?? ''))
        );

        $tingkat = $bagianKelas[0] ?? null;
        $jurusan = $bagianKelas[1] ?? null;

        // Ambil mapel wajib berdasarkan jurusan dan tingkat.
        $pengaturanMapel = collect();

        if ($tingkat && $jurusan) {
            $pengaturanMapel = MapelKelas::with('mapel')
                ->whereRaw('LOWER(TRIM(jurusan)) = ?', [
                    strtolower($jurusan)
                ])
                ->whereRaw('LOWER(TRIM(tingkat)) = ?', [
                    strtolower($tingkat)
                ])
                ->get()
                ->pluck('mapel')
                ->filter()
                ->unique('id_mapel')
                ->values();
        }

        // Ambil nilai pada periode yang dipilih.
        $nilaiPeriode = collect();

        if ($semesterDipilih !== null) {
            $nilaiPeriode = Nilai::with(['mapel', 'rapor'])
                ->where('id_siswa', $siswa->id_siswa)
                ->where('id_rapor', $semesterDipilih)
                ->get()
                ->keyBy('id_mapel');
        }

        // Gabungkan mapel wajib dengan nilai yang tersedia.
        $nilais = $pengaturanMapel->map(function ($mapel) use (
            $nilaiPeriode,
            $periodeAktif
        ) {
            $nilai = $nilaiPeriode->get($mapel->id_mapel);

            return (object) [
                'mapel' => $mapel,
                'rapor' => $periodeAktif,
                'nilai_harian' => $nilai?->nilai_harian,
                'nilai_uts' => $nilai?->nilai_uts,
                'nilai_uas' => $nilai?->nilai_uas,
                'nilai_akhir' => $nilai?->nilai_akhir,
                'predikat' => $nilai?->predikat,
                'status_nilai' => $nilai
                    ? 'Sudah diinput'
                    : 'Belum diinput',
            ];
        });

        // Statistik nilai yang tersedia.
        $nilaiTerisi = $nilais->filter(
            fn ($item) =>
                $item->nilai_akhir !== null &&
                $item->nilai_akhir !== '' &&
                is_numeric($item->nilai_akhir)
        );

        $totalNilaiTerisi = $nilaiTerisi->count();

        $nilaiTerbaik = $nilaiTerisi->isNotEmpty()
            ? $nilaiTerisi->max('nilai_akhir')
            : null;

        return view('siswa.nilai.index', compact(
            'siswa',
            'nilais',
            'semesterList',
            'semesterDipilih',
            'periodeAktif',
            'totalNilaiTerisi',
            'nilaiTerbaik'
        ));
    }

    /**
     * Menampilkan rapor siswa untuk periode tertentu,
     * termasuk mapel yang belum memiliki nilai.
     */
    public function transkrip()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $siswa = Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()
                ->route('siswa.dashboard')
                ->with('error', 'Data siswa belum terhubung dengan akun ini.');
        }

        // Cari data kelas siswa.
        $namaKelasSiswa = trim(
            str_replace('-', ' ', $siswa->kelas ?? '')
        );

        $kelas = Kelas::whereRaw(
            "LOWER(TRIM(REPLACE(nama_kelas, '-', ' '))) = ?",
            [strtolower($namaKelasSiswa)]
        )->first();

        $waliKelas = $kelas->wali_kelas ?? '-';

        // Ambil semua periode rapor, meskipun belum ada nilai.
        $semesterList = Rapor::orderByDesc('id_rapor')->get();

        $semesterDipilih = request('semester');

        $periodeTersedia = $semesterList->contains(
            fn ($item) =>
                (string) $item->id_rapor === (string) $semesterDipilih
        );

        if (!$periodeTersedia) {
            $semesterDipilih = $semesterList->isNotEmpty()
                ? (string) $semesterList->first()->id_rapor
                : null;
        }

        $rapor = $semesterDipilih !== null
            ? $semesterList->first(
                fn ($item) =>
                    (string) $item->id_rapor === (string) $semesterDipilih
            )
            : null;

        // Ambil tingkat dan jurusan kelas.
        $bagianKelas = preg_split(
            '/\s+/',
            trim($namaKelasSiswa)
        );

        $tingkat = $kelas->tingkat ?? ($bagianKelas[0] ?? null);
        $jurusan = $kelas->jurusan ?? ($bagianKelas[1] ?? null);

        // Ambil seluruh mapel wajib kelas siswa.
        $mapelWajib = collect();

        if ($tingkat && $jurusan) {
            $mapelWajib = MapelKelas::with('mapel')
                ->whereRaw('LOWER(TRIM(jurusan)) = ?', [
                    strtolower(trim($jurusan))
                ])
                ->whereRaw('LOWER(TRIM(tingkat)) = ?', [
                    strtolower(trim($tingkat))
                ])
                ->get()
                ->pluck('mapel')
                ->filter()
                ->unique('id_mapel')
                ->values();
        }

        // Ambil nilai sesuai siswa dan periode yang dipilih.
        $nilaiPeriode = collect();

        if ($rapor) {
            $nilaiPeriode = Nilai::with(['mapel', 'rapor'])
                ->where('id_siswa', $siswa->id_siswa)
                ->where('id_rapor', $rapor->id_rapor)
                ->get()
                ->keyBy('id_mapel');
        }

        // Gabungkan mapel wajib dengan nilai yang tersedia.
        $nilais = $mapelWajib->map(
            function ($mapel) use ($nilaiPeriode, $rapor) {
                $nilai = $nilaiPeriode->get($mapel->id_mapel);

                return (object) [
                    'mapel' => $mapel,
                    'rapor' => $rapor,
                    'nilai_harian' => $nilai?->nilai_harian,
                    'nilai_uts' => $nilai?->nilai_uts,
                    'nilai_uas' => $nilai?->nilai_uas,
                    'nilai_akhir' => $nilai?->nilai_akhir,
                    'predikat' => $nilai?->predikat,
                    'status_nilai' => $nilai
                        ? 'Sudah diinput'
                        : 'Belum diinput',
                ];
            }
        );

        // Ambil data cetak rapor jika tersedia.
        $raporSiswa = null;

        if ($rapor) {
            $raporSiswa = RaporSiswa::where(
                'id_siswa',
                $siswa->id_siswa
            )
                ->where('id_rapor', $rapor->id_rapor)
                ->first();
        }

        return view('siswa.transkrip', compact(
            'siswa',
            'nilais',
            'rapor',
            'raporSiswa',
            'semesterList',
            'semesterDipilih',
            'waliKelas'
        ));
    }
}
