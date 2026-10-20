<?php

namespace App\Http\Controllers;

use App\Models\Rapor;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Kelas;
use Illuminate\Http\Request;

class RaporController extends Controller
{
    public function index()
    {
        $rapors = Rapor::orderBy('id_rapor', 'desc')->get();

        return view('admin.rapor.index', compact('rapors'));
    }

    public function create()
    {
        return view('admin.rapor.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        Rapor::create($validated);

        return redirect()
            ->route('admin.rapor.index')
            ->with('success', 'Periode rapor berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rapor = Rapor::where('id_rapor', $id)->firstOrFail();

        return view('admin.rapor.edit', compact('rapor'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        $rapor = Rapor::where('id_rapor', $id)->firstOrFail();

        $rapor->update($validated);

        return redirect()
            ->route('admin.rapor.index')
            ->with('success', 'Periode rapor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rapor = Rapor::where('id_rapor', $id)->firstOrFail();

        $rapor->delete();

        return redirect()
            ->route('admin.rapor.index')
            ->with('success', 'Periode rapor berhasil dihapus.');
    }

    // LIHAT RAPOR
    public function showRapor(Request $request, $id)
    {
        $rapor = Rapor::where('id_rapor', $id)->firstOrFail();

        // Daftar kelas dari data siswa.
        $kelasList = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        $siswaList = collect();

        // Wali kelas.
        $waliKelas = null;

        // Kalau kelas sudah dipilih.
        if ($request->filled('kelas')) {
            $siswaList = Siswa::where('kelas', $request->kelas)
                ->orderBy('nama_siswa')
                ->get();

            // Samakan tanda hubung dan spasi untuk pencarian wali kelas.
            $namaKelas = strtolower(
                str_replace('-', ' ', trim($request->kelas))
            );

            $waliKelas = Kelas::whereRaw(
                "LOWER(REPLACE(TRIM(nama_kelas), '-', ' ')) = ?",
                [$namaKelas]
            )->value('wali_kelas');
        }

        $siswa = null;
        $nilaiList = collect();

        $kelasTerpilih = $request->kelas;

        // Nilai awal jika belum ada siswa yang dipilih.
        $jumlahMapel = 0;
        $rataRataRapor = null;

        // Kalau siswa dipilih.
        if ($request->filled('id_siswa')) {
            $query = Siswa::where('id_siswa', $request->id_siswa);

            if ($request->filled('kelas')) {
                $query->where('kelas', $request->kelas);
            }

            $siswa = $query->first();

            if ($siswa) {
                // Ambil nilai siswa hanya untuk periode rapor terpilih.
                $nilaiList = Nilai::with('mapel')
                    ->where('id_rapor', $rapor->id_rapor)
                    ->where('id_siswa', $siswa->id_siswa)
                    ->orderBy('id_nilai')
                    ->get();

                // Hanya nilai akhir yang sudah terisi yang dihitung.
                $nilaiTerisi = $nilaiList->filter(function ($nilai) {
                    return $nilai->nilai_akhir !== null
                        && $nilai->nilai_akhir !== ''
                        && is_numeric($nilai->nilai_akhir);
                });

                // Jumlah mata pelajaran yang mempunyai nilai akhir.
                $jumlahMapel = $nilaiTerisi->count();

                // Rata-rata nilai akhir semua mata pelajaran.
                $rataRataRapor = $jumlahMapel > 0
                    ? round(
                        $nilaiTerisi->avg(function ($nilai) {
                            return (float) $nilai->nilai_akhir;
                        }),
                        2
                    )
                    : null;
            }
        }

        return view('admin.rapor.show', compact(
            'rapor',
            'kelasList',
            'siswaList',
            'siswa',
            'nilaiList',
            'kelasTerpilih',
            'waliKelas',
            'jumlahMapel',
            'rataRataRapor'
        ));
    }
}