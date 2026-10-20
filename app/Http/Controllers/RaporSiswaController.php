<?php

namespace App\Http\Controllers;

use App\Models\RaporSiswa;
use App\Models\Siswa;
use App\Models\Rapor;
use App\Models\Nilai;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaporSiswaController extends Controller
{
    public function index(Request $request)
    {
        $periodeList = Rapor::orderByDesc('id_rapor')->get();

        $idRapor = $request->input('id_rapor');

        if ($idRapor) {
            $periode = Rapor::find($idRapor);

            if (!$periode) {
                return redirect()
                    ->route('admin.rapor_siswa.index')
                    ->with('error', 'Periode rapor tidak ditemukan.');
            }
        } else {
            $periode = $periodeList->first();
        }

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
            ->distinct()
            ->orderBy('tingkat')
            ->pluck('tingkat');

        $raporSiswaList = collect();

        if ($periode) {
            $query = Siswa::query()->with([
                'raporSiswa' => function ($q) use ($periode) {
                    $q->where('id_rapor', $periode->id_rapor);
                },
            ]);

            if ($request->filled('search')) {
                $search = trim($request->search);

                $query->where(function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%");
                });
            }

            if ($request->filled('kelas')) {
                $query->where('kelas', $request->kelas);
            }

            if (
                $request->filled('jurusan')
                || $request->filled('tingkat')
            ) {
                $query->whereIn('kelas', function ($sub) use ($request) {
                    $sub->select('nama_kelas')->from('kelas');

                    if ($request->filled('jurusan')) {
                        $sub->where('jurusan', $request->jurusan);
                    }

                    if ($request->filled('tingkat')) {
                        $sub->where('tingkat', $request->tingkat);
                    }
                });
            }

            $semuaSiswa = $query->orderBy('nama_siswa')->get();

            foreach ($semuaSiswa as $siswa) {
                $dataRapor = $siswa->raporSiswa->first();

                $nilaiSiswa = Nilai::where(
                    'id_siswa',
                    $siswa->id_siswa
                )
                    ->where('id_rapor', $periode->id_rapor)
                    ->get(['id_mapel']);

                $jumlahNilai = $nilaiSiswa->count();

                // Mencari data kelas siswa.
                $kelasSiswa = Kelas::where(
                    'nama_kelas',
                    $siswa->kelas
                )->first();

                $mapelWajib = collect();

                if ($kelasSiswa) {
                    $mapelWajib = DB::table('mapel_kelas')
                        ->where('jurusan', $kelasSiswa->jurusan)
                        ->where('tingkat', $kelasSiswa->tingkat)
                        ->pluck('id_mapel')
                        ->unique()
                        ->values();
                }

                $idMapelSudahDinilai = $nilaiSiswa
                    ->pluck('id_mapel')
                    ->unique();

                $jumlahMapelWajib = $mapelWajib->count();

                $jumlahMapelTerisi = $mapelWajib
                    ->intersect($idMapelSudahDinilai)
                    ->count();

                $jumlahMapelKurang = max(
                    0,
                    $jumlahMapelWajib - $jumlahMapelTerisi
                );

                if ($jumlahNilai === 0) {
                    $statusRapor = 'Belum Ada Nilai';
                } elseif ($jumlahMapelWajib === 0) {
                    $statusRapor = 'Daftar Mapel Belum Diatur';
                } elseif ($jumlahMapelKurang > 0) {
                    $statusRapor = 'Rapor Belum Lengkap';
                } else {
                    $statusRapor = 'Rapor Lengkap';
                }

                $raporSiswaList->push((object) [
                    'id_rapor_siswa' => $dataRapor?->id_rapor_siswa,
                    'siswa' => $siswa,
                    'rapor' => $periode,
                    'tgl_cetak' => $dataRapor?->tgl_cetak,
                    'jumlah_nilai' => $jumlahNilai,
                    'jumlah_mapel_wajib' => $jumlahMapelWajib,
                    'jumlah_mapel_terisi' => $jumlahMapelTerisi,
                    'jumlah_mapel_kurang' => $jumlahMapelKurang,
                    'status_rapor' => $statusRapor,
                ]);
            }
        }

        return view('admin.rapor_siswa.index', compact(
            'raporSiswaList',
            'periodeList',
            'periode',
            'kelasList',
            'jurusanList',
            'tingkatList'
        ));
    }

    public function create()
    {
        $siswaList = Siswa::orderBy('nama_siswa')->get();
        $raporList = Rapor::orderByDesc('id_rapor')->get();

        return view(
            'admin.rapor_siswa.create',
            compact('siswaList', 'raporList')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_rapor' => 'required|exists:rapor,id_rapor',
            'tgl_cetak' => 'required|date',
            'file_pdf' => 'nullable|string|max:255',
        ]);

        $sudahAda = RaporSiswa::where(
            'id_siswa',
            $validated['id_siswa']
        )
            ->where('id_rapor', $validated['id_rapor'])
            ->exists();

        if ($sudahAda) {
            return redirect()
                ->route('admin.rapor_siswa.index')
                ->with(
                    'error',
                    'Rapor siswa untuk periode tersebut sudah tersedia.'
                );
        }

        RaporSiswa::create($validated);

        return redirect()
            ->route('admin.rapor_siswa.index')
            ->with('success', 'Data rapor siswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Mengambil data rapor, siswa, dan periode.
        $raporSiswa = RaporSiswa::with(['siswa', 'rapor'])
            ->where('id_rapor_siswa', $id)
            ->firstOrFail();

        $siswa = $raporSiswa->siswa;
        $rapor = $raporSiswa->rapor;

        // Mengambil nilai siswa pada periode rapor yang dipilih.
        $nilais = Nilai::with('mapel')
            ->where('id_siswa', $raporSiswa->id_siswa)
            ->where('id_rapor', $raporSiswa->id_rapor)
            ->orderBy('id_nilai')
            ->get();

        // Mengambil data kehadiran pada periode rapor yang sama.
        $kehadiran = DB::table('kehadiran_siswa')
            ->where('id_siswa', $raporSiswa->id_siswa)
            ->where('id_rapor', $raporSiswa->id_rapor)
            ->first();

        // Mengambil data ekstrakurikuler pada periode yang sama.
        $ekstrakurikulerList = DB::table('ekstrakurikuler_siswa')
            ->where('id_siswa', $raporSiswa->id_siswa)
            ->where('id_rapor', $raporSiswa->id_rapor)
            ->orderBy('id_ekstrakurikuler_siswa')
            ->get();

        // Mengirim data ke halaman detail rapor Admin.
        return view(
            'admin.rapor_siswa.show',
            compact(
                'raporSiswa',
                'siswa',
                'rapor',
                'nilais',
                'kehadiran',
                'ekstrakurikulerList'
            )
        );
    }

    public function destroy($id)
    {
        $raporSiswa = RaporSiswa::where('id_rapor_siswa', $id)
            ->firstOrFail();

        $raporSiswa->delete();

        return redirect()
            ->route('admin.rapor_siswa.index')
            ->with('success', 'Data rapor siswa berhasil dihapus.');
    }
}
