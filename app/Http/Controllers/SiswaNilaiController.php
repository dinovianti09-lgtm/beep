<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Rapor;
use App\Models\RaporSiswa;
use App\Models\Kelas;
use App\Models\MapelKelas;
use App\Models\KehadiranSiswa;
use App\Models\EkstrakurikulerSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class SiswaNilaiController extends Controller
{
    /**
     * Mengambil data siswa berdasarkan akun yang login.
     */
    private function getSiswaLogin()
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        return Siswa::where('user_id', $user->id)->first();
    }

    /**
     * Mencari kelas siswa dengan nama kelas yang dinormalisasi.
     */
    private function getKelasSiswa($siswa)
    {
        $namaKelas = trim(
            str_replace('-', ' ', $siswa->kelas ?? '')
        );

        return Kelas::whereRaw(
            "LOWER(TRIM(REPLACE(nama_kelas, '-', ' '))) = ?",
            [strtolower($namaKelas)]
        )->first();
    }

    /**
     * Mengambil tingkat dan jurusan dari data kelas.
     */
    private function getInfoKelas($siswa, $kelas = null)
    {
        $namaKelas = trim(
            str_replace('-', ' ', $siswa->kelas ?? '')
        );

        $bagianKelas = preg_split('/\s+/', $namaKelas);

        return [
            'tingkat' => $kelas->tingkat
                ?? ($bagianKelas[0] ?? null),

            'jurusan' => $kelas->jurusan
                ?? ($bagianKelas[1] ?? null),
        ];
    }

    /**
     * Mengambil mapel wajib berdasarkan tingkat dan jurusan.
     */
    private function getMapelWajib($tingkat, $jurusan)
    {
        if (!$tingkat || !$jurusan) {
            return collect();
        }

        return MapelKelas::with('mapel')
            ->whereRaw('LOWER(TRIM(jurusan)) = ?', [
                strtolower(trim($jurusan)),
            ])
            ->whereRaw('LOWER(TRIM(tingkat)) = ?', [
                strtolower(trim($tingkat)),
            ])
            ->get()
            ->pluck('mapel')
            ->filter()
            ->unique('id_mapel')
            ->values();
    }

    /**
     * Nilai dianggap lengkap jika semua komponen tersedia.
     */
    private function nilaiLengkap($nilai)
    {
        if (!$nilai) {
            return false;
        }

        return is_numeric($nilai->nilai_harian)
            && is_numeric($nilai->nilai_uts)
            && is_numeric($nilai->nilai_uas)
            && is_numeric($nilai->nilai_akhir);
    }

    /**
     * Memilih periode rapor yang diminta.
     */
    private function getPeriode($semesterList)
    {
        $semesterDipilih = request('semester');

        $periodeAktif = $semesterList->first(
            fn ($rapor) =>
                (string) $rapor->id_rapor
                === (string) $semesterDipilih
        );

        if (!$periodeAktif) {
            $periodeAktif = $semesterList->first();
        }

        return [
            'semesterDipilih' => $periodeAktif
                ? (string) $periodeAktif->id_rapor
                : null,

            'periodeAktif' => $periodeAktif,
        ];
    }

    /**
     * Menampilkan nilai siswa dengan pagination.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $siswa = $this->getSiswaLogin();

        if (!$siswa) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Data siswa belum terhubung dengan akun ini.'
                );
        }

        // Ambil daftar periode rapor.
        $semesterList = Rapor::orderByDesc('id_rapor')->get();

        $pilihanPeriode = $this->getPeriode($semesterList);

        $semesterDipilih = $pilihanPeriode['semesterDipilih'];
        $periodeAktif = $pilihanPeriode['periodeAktif'];

        // Ambil data kelas siswa.
        $kelas = $this->getKelasSiswa($siswa);

        $infoKelas = $this->getInfoKelas($siswa, $kelas);

        // Ambil daftar mata pelajaran wajib.
        $pengaturanMapel = $this->getMapelWajib(
            $infoKelas['tingkat'],
            $infoKelas['jurusan']
        );

        // Ambil nilai siswa sesuai periode yang dipilih.
        $nilaiPeriode = collect();

        if ($periodeAktif) {
            $nilaiPeriode = Nilai::with(['mapel', 'rapor'])
                ->where('id_siswa', $siswa->id_siswa)
                ->where('id_rapor', $periodeAktif->id_rapor)
                ->get()
                ->keyBy('id_mapel');
        }

        // Gabungkan mapel wajib dengan nilai yang tersedia.
        $nilais = $pengaturanMapel->map(
            function ($mapel) use ($nilaiPeriode, $periodeAktif) {
                $nilai = $nilaiPeriode->get($mapel->id_mapel);

                if (!$nilai) {
                    $statusNilai = 'Belum diinput';
                } elseif (!$this->nilaiLengkap($nilai)) {
                    $statusNilai = 'Belum lengkap';
                } else {
                    $statusNilai = 'Lengkap';
                }

                return (object) [
                    'mapel' => $mapel,
                    'rapor' => $periodeAktif,
                    'nilai_harian' => $nilai?->nilai_harian,
                    'nilai_uts' => $nilai?->nilai_uts,
                    'nilai_uas' => $nilai?->nilai_uas,
                    'nilai_akhir' => $nilai?->nilai_akhir,
                    'predikat' => $nilai?->predikat,
                    'status_nilai' => $statusNilai,
                ];
            }
        );

        // Statistik dihitung dari seluruh mata pelajaran.
        $totalMapel = $nilais->count();

        $nilaiTerisi = $nilais->filter(function ($item) {
            return is_numeric($item->nilai_harian)
                && is_numeric($item->nilai_uts)
                && is_numeric($item->nilai_uas)
                && is_numeric($item->nilai_akhir);
        });

        $totalNilaiTerisi = $nilaiTerisi->count();

        $nilaiTerbaik = $nilaiTerisi->isNotEmpty()
            ? $nilaiTerisi->max(
                fn ($item) => (float) $item->nilai_akhir
            )
            : null;

        // Pagination: 8 mata pelajaran setiap halaman.
        $perPage = 8;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $pagination = new LengthAwarePaginator(
            $nilais->forPage($currentPage, $perPage)->values(),
            $totalMapel,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        // Tampilkan hanya data untuk halaman yang sedang dibuka.
        $nilais = $pagination->getCollection();

        return view('siswa.nilai.index', compact(
            'siswa',
            'nilais',
            'semesterList',
            'semesterDipilih',
            'periodeAktif',
            'totalNilaiTerisi',
            'nilaiTerbaik',
            'totalMapel',
            'pagination'
        ));
    }

    /**
     * Menampilkan rapor siswa untuk periode tertentu.
     */
    public function transkrip()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $siswa = $this->getSiswaLogin();

        if (!$siswa) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Data siswa belum terhubung dengan akun ini.'
                );
        }

        $kelas = $this->getKelasSiswa($siswa);

        $waliKelas = $kelas->wali_kelas ?? '-';

        $semesterList = Rapor::orderByDesc('id_rapor')->get();

        $pilihanPeriode = $this->getPeriode($semesterList);

        $semesterDipilih = $pilihanPeriode['semesterDipilih'];
        $rapor = $pilihanPeriode['periodeAktif'];

        $infoKelas = $this->getInfoKelas($siswa, $kelas);

        $mapelWajib = $this->getMapelWajib(
            $infoKelas['tingkat'],
            $infoKelas['jurusan']
        );

        // Pastikan nilai hanya milik siswa dan periode yang dipilih.
        $nilaiPeriode = collect();

        if ($rapor) {
            $nilaiPeriode = Nilai::with(['mapel', 'rapor'])
                ->where('id_siswa', $siswa->id_siswa)
                ->where('id_rapor', $rapor->id_rapor)
                ->get()
                ->keyBy('id_mapel');
        }

        $nilais = $mapelWajib->map(
            function ($mapel) use ($nilaiPeriode, $rapor) {
                $nilai = $nilaiPeriode->get($mapel->id_mapel);

                if (!$nilai) {
                    $statusNilai = 'Belum diinput';
                } elseif (!$this->nilaiLengkap($nilai)) {
                    $statusNilai = 'Belum lengkap';
                } else {
                    $statusNilai = 'Lengkap';
                }

                return (object) [
                    'mapel' => $mapel,
                    'rapor' => $rapor,
                    'nilai_harian' => $nilai?->nilai_harian,
                    'nilai_uts' => $nilai?->nilai_uts,
                    'nilai_uas' => $nilai?->nilai_uas,
                    'nilai_akhir' => $nilai?->nilai_akhir,
                    'predikat' => $nilai?->predikat,
                    'status_nilai' => $statusNilai,
                ];
            }
        );

        // Ambil data cetak rapor jika tersedia.
        $raporSiswa = null;

        $kehadiran = null;
        $ekstrakurikulerList = collect();

        if ($rapor) {
            $idSiswa = $siswa->id_siswa;
            $idRapor = $rapor->id_rapor;

            $raporSiswa = RaporSiswa::where(
                'id_siswa',
                $idSiswa
            )
                ->where('id_rapor', $idRapor)
                ->first();

            // Ambil kehadiran sesuai siswa dan periode rapor.
            $kehadiran = KehadiranSiswa::where(
                'id_siswa',
                $idSiswa
            )
                ->where('id_rapor', $idRapor)
                ->first();

            // Ambil ekstrakurikuler siswa untuk periode tersebut.
            $ekstrakurikulerList = EkstrakurikulerSiswa::where(
                'id_siswa',
                $idSiswa
            )
                ->where('id_rapor', $idRapor)
                ->get();
        }

        return view('siswa.transkrip', compact(
            'siswa',
            'nilais',
            'rapor',
            'raporSiswa',
            'semesterList',
            'semesterDipilih',
            'waliKelas',
            'kehadiran',
            'ekstrakurikulerList'
        ));
    }
}