<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Rapor;
use App\Models\Nilai;
use App\Models\Mapel;
use App\Models\KehadiranSiswa;
use App\Models\EkstrakurikulerSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruRaporController extends Controller
{
    /**
     * Memastikan guru yang login merupakan wali kelas.
     */
    private function dataWaliKelas()
    {
        $user = Auth::user();

        $guru = Guru::where('user_id', $user->id)->first();

        abort_unless($guru, 403, 'Data guru tidak ditemukan.');

        $kelasWali = Kelas::where(
            'wali_kelas',
            $guru->nama_guru
        )->first();

        abort_unless(
            $kelasWali,
            403,
            'Menu rapor hanya dapat diakses oleh wali kelas.'
        );

        return [$guru, $kelasWali];
    }

    /**
     * Menampilkan daftar periode rapor yang tersedia.
     */
    public function index()
    {
        [$guru, $kelasWali] = $this->dataWaliKelas();

        $raporList = Rapor::whereHas('nilai', function ($query) use ($kelasWali) {
            $query->whereHas('siswa', function ($siswaQuery) use ($kelasWali) {
                $siswaQuery->where('kelas', $kelasWali->nama_kelas);
            });
        })
            ->orderByDesc('id_rapor')
            ->get();

        $jumlahSiswa = Siswa::where(
            'kelas',
            $kelasWali->nama_kelas
        )->count();

        return view('guru.rapor.index', compact(
            'guru',
            'kelasWali',
            'raporList',
            'jumlahSiswa'
        ));
    }

    /**
     * Menampilkan detail rapor siswa.
     */
    public function show(Request $request, $id)
    {
        [$guru, $kelasWali] = $this->dataWaliKelas();

        // Pastikan periode rapor memiliki nilai dari siswa kelas wali.
        $rapor = Rapor::where('id_rapor', $id)
            ->whereHas('nilai', function ($query) use ($kelasWali) {
                $query->whereHas('siswa', function ($siswaQuery) use ($kelasWali) {
                    $siswaQuery->where('kelas', $kelasWali->nama_kelas);
                });
            })
            ->firstOrFail();

        // Daftar siswa yang berada di kelas wali.
        $siswaList = Siswa::where(
            'kelas',
            $kelasWali->nama_kelas
        )
            ->orderBy('nama_siswa')
            ->get();

        // Nilai default sebelum siswa dipilih.
        $siswa = null;
        $nilaiList = collect();
        $daftarMapel = collect();
        $jumlahMapel = 0;
        $totalMapel = 0;
        $rataRataRapor = null;
        $belumLengkapMapel = collect();

        // Data tambahan rapor.
        $kehadiran = null;
        $ekstrakurikulerList = collect();

        if ($request->filled('id_siswa')) {
            // Pastikan siswa memang berada di kelas wali.
            $siswa = Siswa::where(
                'id_siswa',
                $request->id_siswa
            )
                ->where('kelas', $kelasWali->nama_kelas)
                ->first();

            abort_unless(
                $siswa,
                404,
                'Siswa tidak ditemukan di kelas wali Anda.'
            );

            /*
             * Ambil semua nilai siswa pada periode ini.
             * Mata pelajaran di luar daftar wajib tetap ditampilkan
             * jika nilainya sudah tersimpan.
             */
            $nilaiList = Nilai::with('mapel')
                ->where('id_rapor', $rapor->id_rapor)
                ->where('id_siswa', $siswa->id_siswa)
                ->orderBy('id_nilai')
                ->get();

            /*
             * Ambil kehadiran berdasarkan siswa dan periode rapor.
             * Jika belum pernah diisi, nilainya null.
             */
            $kehadiran = KehadiranSiswa::where(
                'id_siswa',
                $siswa->id_siswa
            )
                ->where('id_rapor', $rapor->id_rapor)
                ->first();

            /*
             * Ambil seluruh ekstrakurikuler siswa pada periode ini.
             */
            $ekstrakurikulerList = EkstrakurikulerSiswa::where(
                'id_siswa',
                $siswa->id_siswa
            )
                ->where('id_rapor', $rapor->id_rapor)
                ->orderBy('id_ekstrakurikuler_siswa')
                ->get();

            /*
             * Tentukan tingkat dan jurusan berdasarkan nama kelas.
             * Contoh: XII RPL 5.
             */
            $namaKelas = strtoupper(trim($kelasWali->nama_kelas));

            $tingkat = null;
            $jurusan = null;

            if (preg_match('/^(XII|XI|X)\b/', $namaKelas, $cocok)) {
                $tingkat = $cocok[1];
            }

            if (preg_match('/\b(RPL|PPLG|DKV|TKJ|AKL|MPLB|OTKP|BDP)\b/', $namaKelas, $cocok)) {
                $jurusan = $cocok[1];
            }

            /*
             * Ambil mata pelajaran wajib sesuai jurusan dan tingkat
             * dari tabel mapel_kelas.
             */
            if ($tingkat && $jurusan) {
                $daftarMapel = Mapel::whereIn(
                    'id_mapel',
                    DB::table('mapel_kelas')
                        ->select('id_mapel')
                        ->where('jurusan', $jurusan)
                        ->where('tingkat', $tingkat)
                )
                    ->orderBy('nama_mapel')
                    ->get();
            }

            $totalMapel = $daftarMapel->count();

            // Periksa kelengkapan nilai untuk setiap mapel wajib.
            $nilaiLengkap = collect();

            foreach ($daftarMapel as $mapel) {
                $nilai = $nilaiList->first(function ($item) use ($mapel) {
                    return (string) $item->id_mapel
                        === (string) $mapel->id_mapel;
                });

                $lengkap = $nilai !== null
                    && is_numeric($nilai->nilai_harian)
                    && is_numeric($nilai->nilai_uts)
                    && is_numeric($nilai->nilai_uas)
                    && is_numeric($nilai->nilai_akhir);

                if ($lengkap) {
                    $nilaiLengkap->push($nilai);
                } else {
                    $belumLengkapMapel->push($mapel->nama_mapel);
                }
            }

            $jumlahMapel = $nilaiLengkap->count();

            /*
             * Rata-rata rapor hanya dihitung jika semua
             * mata pelajaran wajib sudah memiliki nilai lengkap.
             */
            if (
                $totalMapel > 0
                && $belumLengkapMapel->isEmpty()
            ) {
                $rataRataRapor = round(
                    $nilaiLengkap->avg(function ($nilai) {
                        return (float) $nilai->nilai_akhir;
                    }),
                    2
                );
            }
        }

        return view('guru.rapor.show', compact(
            'guru',
            'kelasWali',
            'rapor',
            'siswaList',
            'siswa',
            'nilaiList',
            'daftarMapel',
            'jumlahMapel',
            'totalMapel',
            'rataRataRapor',
            'belumLengkapMapel',
            'kehadiran',
            'ekstrakurikulerList'
        ));
    }
}
