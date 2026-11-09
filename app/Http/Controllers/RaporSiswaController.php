<?php

namespace App\Http\Controllers;

use App\Models\RaporSiswa;
use App\Models\Siswa;
use App\Models\Rapor;
use App\Models\Nilai;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class RaporSiswaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR RAPOR SISWA
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $periodeList = Rapor::orderByDesc('id_rapor')->get();

        $idRaporTerpilih = trim(
            (string) $request->input('id_rapor', 'all')
        );

        $periode = null;

        if ($idRaporTerpilih === '' || $idRaporTerpilih === 'all') {
            $idRaporTerpilih = 'all';
            $periodeTerpilihList = $periodeList;
        } else {
            $periode = Rapor::where(
                'id_rapor',
                $idRaporTerpilih
            )->first();

            if (!$periode) {
                return redirect()
                    ->route('admin.rapor_siswa.index')
                    ->with('error', 'Periode rapor tidak ditemukan.');
            }

            $periodeTerpilihList = collect([$periode]);
        }

        $periodeIds = $periodeTerpilihList
            ->pluck('id_rapor')
            ->all();


        /*
        |--------------------------------------------------------------------------
        | DATA KELAS DAN FILTER
        |--------------------------------------------------------------------------
        */

        $kelasList = Kelas::orderBy('tingkat')
            ->orderBy('jurusan')
            ->orderBy('nama_kelas')
            ->get();

        $jurusanList = Kelas::whereNotNull('jurusan')
            ->where('jurusan', '!=', '')
            ->distinct()
            ->orderBy('jurusan')
            ->pluck('jurusan');

        $tingkatList = Kelas::whereNotNull('tingkat')
            ->where('tingkat', '!=', '')
            ->distinct()
            ->orderBy('tingkat')
            ->pluck('tingkat');


        /*
        |--------------------------------------------------------------------------
        | DATA RAPOR SISWA
        |--------------------------------------------------------------------------
        */

        $raporSiswaList = collect();

        if (!empty($periodeIds)) {

            $query = Siswa::query()->with([
                'raporSiswa' => function ($q) use ($periodeIds) {
                    $q->whereIn('id_rapor', $periodeIds);
                },
            ]);

            // Pencarian nama siswa atau NIS.
            if ($request->filled('search')) {

                $search = trim($request->search);

                $query->where(function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%");
                });
            }

            // Filter kelas.
            if ($request->filled('kelas')) {
                $query->where('kelas', $request->kelas);
            }

            // Filter jurusan dan tingkat.
            if (
                $request->filled('jurusan') ||
                $request->filled('tingkat')
            ) {

                $query->whereIn('kelas', function ($sub) use ($request) {

                    $sub->select('nama_kelas')
                        ->from('kelas');

                    if ($request->filled('jurusan')) {
                        $sub->where('jurusan', $request->jurusan);
                    }

                    if ($request->filled('tingkat')) {
                        $sub->where('tingkat', $request->tingkat);
                    }
                });
            }

            $semuaSiswa = $query
                ->orderBy('nama_siswa')
                ->get();


            /*
            |--------------------------------------------------------------------------
            | AMBIL NILAI SEMUA PERIODE SEKALIGUS
            |--------------------------------------------------------------------------
            */

            $nilaiBySiswaPeriode = Nilai::whereIn(
                'id_rapor',
                $periodeIds
            )
                ->get()
                ->groupBy(function ($nilai) {
                    return $nilai->id_siswa . '_' . $nilai->id_rapor;
                });


            /*
            |--------------------------------------------------------------------------
            | CACHE DATA KELAS
            |--------------------------------------------------------------------------
            */

            $kelasByNama = $kelasList->keyBy(function ($kelas) {

                return strtolower(str_replace(
                    '-',
                    ' ',
                    trim((string) $kelas->nama_kelas)
                ));
            });

            $mapelWajibCache = [];


            /*
            |--------------------------------------------------------------------------
            | PROSES SETIAP PERIODE DAN SISWA
            |--------------------------------------------------------------------------
            */

            foreach ($periodeTerpilihList as $periodeItem) {

                foreach ($semuaSiswa as $siswa) {

                    // Cari data rapor siswa pada periode ini.
                    $dataRapor = $siswa->raporSiswa->firstWhere(
                        'id_rapor',
                        $periodeItem->id_rapor
                    );

                    // Ambil nilai siswa pada periode ini.
                    $keyNilai = $siswa->id_siswa .
                        '_' . $periodeItem->id_rapor;

                    $nilaiSiswa = $nilaiBySiswaPeriode->get(
                        $keyNilai,
                        collect()
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | CARI KELAS SISWA
                    |--------------------------------------------------------------------------
                    */

                    $namaKelasSiswa = strtolower(str_replace(
                        '-',
                        ' ',
                        trim((string) $siswa->kelas)
                    ));

                    $kelasSiswa = $kelasByNama->get($namaKelasSiswa);

                    $mapelWajib = collect();

                    if ($kelasSiswa) {

                        $cacheKey = strtoupper(trim(
                            (string) $kelasSiswa->jurusan
                        )) . '|' . strtoupper(trim(
                            (string) $kelasSiswa->tingkat
                        ));

                        if (!array_key_exists($cacheKey, $mapelWajibCache)) {

                            $mapelWajibCache[$cacheKey] = DB::table('mapel_kelas')
                                ->where('jurusan', $kelasSiswa->jurusan)
                                ->where('tingkat', $kelasSiswa->tingkat)
                                ->pluck('id_mapel')
                                ->unique()
                                ->values();
                        }

                        $mapelWajib = $mapelWajibCache[$cacheKey];
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | HITUNG KELENGKAPAN NILAI
                    |--------------------------------------------------------------------------
                    */

                    $jumlahMapelWajib = $mapelWajib->count();

                    $jumlahNilaiLengkap = 0;

                    foreach ($mapelWajib as $idMapel) {

                        $nilai = $nilaiSiswa->firstWhere(
                            'id_mapel',
                            $idMapel
                        );

                        if (
                            $nilai &&
                            is_numeric($nilai->nilai_harian) &&
                            is_numeric($nilai->nilai_uts) &&
                            is_numeric($nilai->nilai_uas) &&
                            is_numeric($nilai->nilai_akhir)
                        ) {
                            $jumlahNilaiLengkap++;
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | STATUS RAPOR
                    |--------------------------------------------------------------------------
                    */

                    if (!$dataRapor) {

                        $statusRapor = 'Belum Ada Rapor';

                    } elseif ($jumlahMapelWajib === 0) {

                        $statusRapor = 'Daftar Mapel Belum Diatur';

                    } elseif ($jumlahNilaiLengkap === 0) {

                        $statusRapor = 'Belum Ada Nilai Lengkap';

                    } elseif ($jumlahNilaiLengkap < $jumlahMapelWajib) {

                        $statusRapor = 'Rapor Belum Lengkap';

                    } else {

                        $statusRapor = 'Rapor Lengkap';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | TANGGAL CETAK
                    |--------------------------------------------------------------------------
                    |
                    | Tanggal cetak hanya ditampilkan jika rapor lengkap.
                    | Rapor yang belum lengkap tidak dianggap sudah dicetak.
                    |
                    */

                    $tanggalCetak = null;

                    if (
                        $dataRapor &&
                        $statusRapor === 'Rapor Lengkap'
                    ) {
                        $tanggalCetak = $dataRapor->tgl_cetak;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | MASUKKAN DATA KE DAFTAR
                    |--------------------------------------------------------------------------
                    */

                    $raporSiswaList->push((object) [

                        'id_rapor_siswa' => $dataRapor?->id_rapor_siswa,

                        'siswa' => $siswa,

                        'rapor' => $periodeItem,

                        'tgl_cetak' => $tanggalCetak,

                        'jumlah_nilai' => $nilaiSiswa->count(),

                        'jumlah_mapel_wajib' => $jumlahMapelWajib,

                        'jumlah_mapel_terisi' => $jumlahNilaiLengkap,

                        'jumlah_mapel_kurang' => max(
                            0,
                            $jumlahMapelWajib - $jumlahNilaiLengkap
                        ),

                        'status_rapor' => $statusRapor,
                    ]);
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | URUTKAN DATA
        |--------------------------------------------------------------------------
        */

        $raporSiswaList = $raporSiswaList
            ->sortBy([
                ['siswa.nama_siswa', 'asc'],
                ['rapor.id_rapor', 'asc'],
            ])
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PAGINATION 10 DATA PER HALAMAN
        |--------------------------------------------------------------------------
        */

        $totalData = $raporSiswaList->count();

        $perPage = 10;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $raporSiswaList = new LengthAwarePaginator(
            $raporSiswaList
                ->forPage($currentPage, $perPage)
                ->values(),
            $totalData,
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.rapor_siswa.index', compact(
            'raporSiswaList',
            'periodeList',
            'periode',
            'idRaporTerpilih',
            'kelasList',
            'jurusanList',
            'tingkatList'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL RAPOR SISWA
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $raporSiswa = RaporSiswa::with(['siswa', 'rapor'])
            ->where('id_rapor_siswa', $id)
            ->firstOrFail();

        $siswa = $raporSiswa->siswa;
        $rapor = $raporSiswa->rapor;

        // Ambil nilai berdasarkan siswa dan periode.
        $nilais = Nilai::with('mapel')
            ->where('id_siswa', $raporSiswa->id_siswa)
            ->where('id_rapor', $raporSiswa->id_rapor)
            ->orderByDesc('id_nilai')
            ->get();

        // Ambil data kehadiran.
        $kehadiran = DB::table('kehadiran_siswa')
            ->where('id_siswa', $raporSiswa->id_siswa)
            ->where('id_rapor', $raporSiswa->id_rapor)
            ->first();

        // Ambil data ekstrakurikuler.
        $ekstrakurikulerList = DB::table('ekstrakurikuler_siswa')
            ->where('id_siswa', $raporSiswa->id_siswa)
            ->where('id_rapor', $raporSiswa->id_rapor)
            ->orderBy('id_ekstrakurikuler_siswa')
            ->get();

        // Cocokkan kelas siswa dengan tabel kelas.
        $namaKelasSiswa = strtolower(
            str_replace('-', ' ', trim($siswa->kelas ?? ''))
        );

        $kelasSiswa = Kelas::whereRaw(
            "LOWER(REPLACE(TRIM(nama_kelas), '-', ' ')) = ?",
            [$namaKelasSiswa]
        )->first();


        /*
        |--------------------------------------------------------------------------
        | PERIKSA KELENGKAPAN RAPOR
        |--------------------------------------------------------------------------
        |
        | Rapor hanya dianggap lengkap jika seluruh mata pelajaran
        | wajib memiliki nilai harian, UTS, UAS, dan nilai akhir.
        |
        */

        $raporLengkap = false;

        if ($kelasSiswa) {

            $mapelWajib = DB::table('mapel_kelas')
                ->where('jurusan', $kelasSiswa->jurusan)
                ->where('tingkat', $kelasSiswa->tingkat)
                ->pluck('id_mapel')
                ->unique()
                ->values();

            if ($mapelWajib->isNotEmpty()) {

                $jumlahNilaiLengkap = 0;

                foreach ($mapelWajib as $idMapel) {

                    $nilai = $nilais->firstWhere(
                        'id_mapel',
                        $idMapel
                    );

                    if (
                        $nilai &&
                        is_numeric($nilai->nilai_harian) &&
                        is_numeric($nilai->nilai_uts) &&
                        is_numeric($nilai->nilai_uas) &&
                        is_numeric($nilai->nilai_akhir)
                    ) {
                        $jumlahNilaiLengkap++;
                    }
                }

                $raporLengkap = (
                    $jumlahNilaiLengkap === $mapelWajib->count()
                );
            }
        }


        // Ambil nama dan NIP wali kelas.
        $waliKelas = null;
        $nipWaliKelas = null;

        if ($kelasSiswa && !empty($kelasSiswa->wali_kelas)) {

            $namaWaliKelas = trim($kelasSiswa->wali_kelas);

            $guruWaliKelas = DB::table('guru')
                ->whereRaw(
                    'TRIM(nama_guru) = ?',
                    [$namaWaliKelas]
                )
                ->first();

            if ($guruWaliKelas) {

                $waliKelas = $guruWaliKelas->nama_guru;
                $nipWaliKelas = $guruWaliKelas->nip;

            } else {

                $waliKelas = $namaWaliKelas;
            }
        }

        // Data kepala sekolah.
        $kepalaSekolah = 'Ahmad Fadilah';
        $nipKepalaSekolah = null;

        return view(
            'admin.rapor_siswa.show',
            compact(
                'raporSiswa',
                'siswa',
                'rapor',
                'nilais',
                'raporLengkap',
                'kehadiran',
                'ekstrakurikulerList',
                'waliKelas',
                'nipWaliKelas',
                'kepalaSekolah',
                'nipKepalaSekolah'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CETAK RAPOR SISWA
    |--------------------------------------------------------------------------
    |
    | Memeriksa kelengkapan nilai, menyimpan tgl_cetak ke database,
    | lalu kembali ke halaman detail dan memunculkan dialog Print browser.
    |
    */

    public function cetak($id)
    {
        $raporSiswa = RaporSiswa::with(['siswa', 'rapor'])
            ->where('id_rapor_siswa', $id)
            ->firstOrFail();

        $siswa = $raporSiswa->siswa;

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Cari kelas siswa.
        $namaKelasSiswa = strtolower(
            str_replace('-', ' ', trim($siswa->kelas ?? ''))
        );

        $kelasSiswa = Kelas::whereRaw(
            "LOWER(REPLACE(TRIM(nama_kelas), '-', ' ')) = ?",
            [$namaKelasSiswa]
        )->first();

        if (!$kelasSiswa) {
            return back()->with('error', 'Data kelas belum ditemukan.');
        }

        // Ambil mata pelajaran wajib.
        $mapelWajib = DB::table('mapel_kelas')
            ->where('jurusan', $kelasSiswa->jurusan)
            ->where('tingkat', $kelasSiswa->tingkat)
            ->pluck('id_mapel')
            ->unique();

        if ($mapelWajib->isEmpty()) {
            return back()->with(
                'error',
                'Daftar mata pelajaran wajib belum diatur.'
            );
        }

        // Ambil nilai siswa.
        $nilaiSiswa = Nilai::where('id_siswa', $raporSiswa->id_siswa)
            ->where('id_rapor', $raporSiswa->id_rapor)
            ->get();

        // Periksa kelengkapan seluruh nilai.
        foreach ($mapelWajib as $idMapel) {

            $nilai = $nilaiSiswa->firstWhere('id_mapel', $idMapel);

            if (
                !$nilai ||
                !is_numeric($nilai->nilai_harian) ||
                !is_numeric($nilai->nilai_uts) ||
                !is_numeric($nilai->nilai_uas) ||
                !is_numeric($nilai->nilai_akhir)
            ) {
                return back()->with(
                    'error',
                    'Rapor belum lengkap. Lengkapi seluruh nilai terlebih dahulu.'
                );
            }
        }

        // Simpan tanggal cetak.
        $raporSiswa->update([
            'tgl_cetak' => now(),
        ]);

        // Kembali ke halaman detail dan jalankan proses print.
        return redirect()
            ->route('admin.rapor_siswa.show', $id)
            ->with('success', 'Rapor berhasil dicetak.')
            ->with('cetak_rapor', true);
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS RAPOR SISWA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $raporSiswa = RaporSiswa::where(
            'id_rapor_siswa',
            $id
        )->firstOrFail();

        $raporSiswa->delete();

        return redirect()
            ->route('admin.rapor_siswa.index')
            ->with('success', 'Data rapor siswa berhasil dihapus.');
    }
}