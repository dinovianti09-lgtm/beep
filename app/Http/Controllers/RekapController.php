<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Rapor;
use App\Models\BobotNilai;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    /**
     * Mengambil data Guru yang sedang login.
     */
    private function guruLogin(): Guru
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'guru',
            403
        );

        $guru = Guru::where('user_id', auth()->id())->first();

        if (!$guru) {
            abort(403, 'Data Guru untuk akun ini tidak ditemukan.');
        }

        return $guru;
    }

    /**
     * Mengambil mata pelajaran yang diampu Guru.
     */
    private function mapelGuru(Guru $guru): Mapel
    {
        if (empty($guru->mapel_diampu)) {
            abort(403, 'Mata pelajaran Guru belum ditentukan.');
        }

        $mapel = Mapel::whereRaw(
            'LOWER(TRIM(nama_mapel)) = ?',
            [strtolower(trim($guru->mapel_diampu))]
        )->first();

        if (!$mapel) {
            abort(403, 'Mata pelajaran Guru tidak ditemukan.');
        }

        return $mapel;
    }

    /**
     * Mengambil kelas yang diajar Guru.
     */
    private function kelasGuru(Guru $guru)
    {
        return $guru->kelasDiajar()
            ->orderBy('nama_kelas')
            ->get();
    }

    /**
     * Menormalkan nama kelas.
     */
    private function namaKelasGuru($kelasDiajar): array
    {
        $namaKelas = $kelasDiajar
            ->pluck('nama_kelas')
            ->map(function ($nama) {
                return str_replace('-', ' ', trim($nama));
            })
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        if (empty($namaKelas)) {
            abort(403, 'Akun Guru belum memiliki kelas yang ditugaskan.');
        }

        return $namaKelas;
    }

    /**
     * Membatasi data siswa sesuai kelas yang diajar Guru.
     */
    private function siswaDiKelasGuru($query, array $namaKelasDiajar): void
    {
        $query->whereNotNull('kelas')
            ->where(function ($subQuery) use ($namaKelasDiajar) {
                foreach ($namaKelasDiajar as $namaKelas) {
                    $subQuery->orWhereRaw(
                        "REPLACE(TRIM(kelas), '-', ' ') = ?",
                        [$namaKelas]
                    );
                }
            });
    }

    /**
     * Mengubah semester rapor menjadi angka.
     */
    private function jenisSemester($semester): ?int
    {
        $semester = strtolower(trim((string) $semester));

        if (in_array($semester, ['1', 'ganjil'], true)) {
            return 1;
        }

        if (in_array($semester, ['2', 'genap'], true)) {
            return 2;
        }

        return null;
    }

    /**
     * Menghitung nilai akhir berdasarkan bobot mapel dan periode rapor.
     * Jika bobot belum diatur, gunakan bobot bawaan 30/30/40.
     */
    private function hitungNilaiAkhir(
        float $harian,
        float $uts,
        float $uas,
        int $idMapel,
        int $idRapor
    ): array {
        $bobot = BobotNilai::where('id_mapel', $idMapel)
            ->where('id_rapor', $idRapor)
            ->first();

        $bobotHarian = (float) ($bobot->bobot_harian ?? 30);
        $bobotUts = (float) ($bobot->bobot_uts ?? 30);
        $bobotUas = (float) ($bobot->bobot_uas ?? 40);

        $nilaiAkhir = (
            ($harian * $bobotHarian / 100)
            + ($uts * $bobotUts / 100)
            + ($uas * $bobotUas / 100)
        );

        if ($nilaiAkhir >= 90) {
            $predikat = 'A';
        } elseif ($nilaiAkhir >= 80) {
            $predikat = 'B';
        } elseif ($nilaiAkhir >= 70) {
            $predikat = 'C';
        } else {
            $predikat = 'D';
        }

        return [
            'nilai_akhir' => round($nilaiAkhir, 2),
            'predikat' => $predikat,
        ];
    }

    /**
     * REKAP NILAI GURU
     */
    public function index(Request $request)
    {
        $guru = $this->guruLogin();
        $mapel = $this->mapelGuru($guru);

        $kelasDiajar = $this->kelasGuru($guru);
        $namaKelasDiajar = $this->namaKelasGuru($kelasDiajar);

        // Kata kunci pencarian nama siswa atau NIS.
        $search = trim((string) $request->query('search', ''));

        // Filter kelas hanya menerima kelas yang memang diajar Guru.
        $kelasTerpilih = $request->query('kelas');

        if ($kelasTerpilih !== null && trim($kelasTerpilih) !== '') {
            $kelasTerpilih = str_replace(
                '-',
                ' ',
                trim($kelasTerpilih)
            );

            if (!in_array($kelasTerpilih, $namaKelasDiajar, true)) {
                $kelasTerpilih = null;
            }
        } else {
            $kelasTerpilih = null;
        }

        // Filter semester.
        $semesterTerpilih = $request->query('semester');

        if (!in_array((string) $semesterTerpilih, ['1', '2'], true)) {
            $semesterTerpilih = null;
        } else {
            $semesterTerpilih = (string) $semesterTerpilih;
        }

        $rekaps = Nilai::with(['siswa', 'mapel', 'rapor'])
            // Hanya mata pelajaran Guru yang sedang login.
            ->where('nilai.id_mapel', $mapel->id_mapel)

            // Pastikan angka semester sesuai dengan periode rapor.
            ->where(function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('nilai.semester', 1)
                        ->whereHas('rapor', function ($raporQuery) {
                            $raporQuery->whereRaw(
                                'LOWER(TRIM(semester)) = ?',
                                ['ganjil']
                            );
                        });
                })->orWhere(function ($subQuery) {
                    $subQuery->where('nilai.semester', 2)
                        ->whereHas('rapor', function ($raporQuery) {
                            $raporQuery->whereRaw(
                                'LOWER(TRIM(semester)) = ?',
                                ['genap']
                            );
                        });
                });
            })

            // Filter semester.
            ->when($semesterTerpilih !== null, function ($query) use ($semesterTerpilih) {
                $query->where(
                    'nilai.semester',
                    (int) $semesterTerpilih
                );
            })

            // Batasi data siswa ke kelas yang diajar Guru.
            ->whereHas('siswa', function ($query) use (
                $namaKelasDiajar,
                $kelasTerpilih,
                $search
            ) {
                $this->siswaDiKelasGuru($query, $namaKelasDiajar);

                if ($kelasTerpilih !== null) {
                    $query->whereRaw(
                        "REPLACE(TRIM(kelas), '-', ' ') = ?",
                        [$kelasTerpilih]
                    );
                }

                // Pencarian nama siswa atau NIS.
                if ($search !== '') {
                    $query->where(function ($searchQuery) use ($search) {
                        $searchQuery
                            ->where('nama_siswa', 'LIKE', '%' . $search . '%')
                            ->orWhere('nis', 'LIKE', '%' . $search . '%');
                    });
                }
            })

            ->orderByDesc('nilai.id_nilai')

            // Pagination 10 data per halaman.
            ->paginate(10)
            ->withQueryString();

        return view('guru.rekap.index', compact(
            'rekaps',
            'guru',
            'mapel',
            'kelasDiajar',
            'kelasTerpilih',
            'semesterTerpilih'
        ));
    }

    /**
     * FORM EDIT NILAI
     */
    public function edit($id)
    {
        $guru = $this->guruLogin();
        $mapel = $this->mapelGuru($guru);

        $kelasDiajar = $this->kelasGuru($guru);
        $namaKelasDiajar = $this->namaKelasGuru($kelasDiajar);

        $nilai = Nilai::with(['siswa', 'mapel', 'rapor'])
            ->where('id_nilai', $id)
            ->where('id_mapel', $mapel->id_mapel)
            ->whereHas('siswa', function ($query) use ($namaKelasDiajar) {
                $this->siswaDiKelasGuru($query, $namaKelasDiajar);
            })
            ->first();

        if (!$nilai) {
            return redirect()
                ->route('guru.rekap.index')
                ->with(
                    'error',
                    'Nilai tidak ditemukan atau bukan bagian dari kelas/mapel yang Anda ajar.'
                );
        }

        // Mengambil siswa dari kelas yang diajar Guru.
        $siswaList = Siswa::where(function ($query) use ($namaKelasDiajar) {
            $this->siswaDiKelasGuru($query, $namaKelasDiajar);
        })
            ->orderBy('nama_siswa')
            ->get();

        // Mengambil seluruh periode rapor.
        $raporList = Rapor::orderByDesc('id_rapor')->get();

        // Mengambil bobot nilai sesuai mapel Guru dan periode rapor.
        // Data ini digunakan untuk preview perhitungan di halaman edit.
        $bobotNilai = BobotNilai::where('id_mapel', $mapel->id_mapel)
            ->whereIn('id_rapor', $raporList->pluck('id_rapor'))
            ->get()
            ->keyBy('id_rapor');

        return view('guru.rekap.edit', compact(
            'nilai',
            'guru',
            'mapel',
            'siswaList',
            'raporList',
            'kelasDiajar',
            'bobotNilai'
        ));
    }

    /**
     * UPDATE NILAI
     */
    public function update(Request $request, $id)
    {
        $guru = $this->guruLogin();
        $mapel = $this->mapelGuru($guru);

        $kelasDiajar = $this->kelasGuru($guru);
        $namaKelasDiajar = $this->namaKelasGuru($kelasDiajar);

        $nilai = Nilai::where('id_nilai', $id)
            ->where('id_mapel', $mapel->id_mapel)
            ->whereHas('siswa', function ($query) use ($namaKelasDiajar) {
                $this->siswaDiKelasGuru($query, $namaKelasDiajar);
            })
            ->first();

        if (!$nilai) {
            return redirect()
                ->route('guru.rekap.index')
                ->with(
                    'error',
                    'Nilai tidak ditemukan atau bukan bagian dari kelas/mapel yang Anda ajar.'
                );
        }

        $validated = $request->validate([
            'id_siswa' => 'required|integer|exists:siswa,id_siswa',
            'id_rapor' => 'required|integer|exists:rapor,id_rapor',
            'nilai_harian' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
            'semester' => 'required|integer|in:1,2',
        ]);

        // Pastikan siswa tujuan masih berada di kelas yang diajar Guru.
        $siswaValid = Siswa::where(
            'id_siswa',
            $validated['id_siswa']
        )
            ->where(function ($query) use ($namaKelasDiajar) {
                $this->siswaDiKelasGuru($query, $namaKelasDiajar);
            })
            ->exists();

        if (!$siswaValid) {
            return back()
                ->withErrors([
                    'id_siswa' => 'Siswa tersebut bukan bagian dari kelas yang Anda ajar.'
                ])
                ->withInput();
        }

        $rapor = Rapor::findOrFail($validated['id_rapor']);
        $jenisRapor = $this->jenisSemester($rapor->semester);

        if (
            $jenisRapor === null ||
            (int) $validated['semester'] !== $jenisRapor
        ) {
            return back()
                ->withErrors([
                    'semester' => 'Semester yang dipilih tidak sesuai dengan periode rapor.'
                ])
                ->withInput();
        }

        if (empty($rapor->tahun_ajaran)) {
            return back()
                ->withErrors([
                    'id_rapor' => 'Tahun ajaran pada rapor belum ditentukan.'
                ])
                ->withInput();
        }

        // Cegah nilai ganda untuk siswa, mapel, rapor, dan semester yang sama.
        $nilaiDuplikat = Nilai::where(
            'id_siswa',
            $validated['id_siswa']
        )
            ->where('id_mapel', $mapel->id_mapel)
            ->where('id_rapor', $validated['id_rapor'])
            ->where('semester', $validated['semester'])
            ->where('id_nilai', '!=', $nilai->id_nilai)
            ->exists();

        if ($nilaiDuplikat) {
            return back()
                ->withErrors([
                    'id_siswa' => 'Nilai untuk siswa, mapel, rapor, dan semester tersebut sudah ada.'
                ])
                ->withInput();
        }

        $nilaiHarian = (float) $validated['nilai_harian'];
        $nilaiUts = (float) $validated['nilai_uts'];
        $nilaiUas = (float) $validated['nilai_uas'];

        // Gunakan bobot untuk mapel dan periode rapor yang dipilih.
        $hasilPerhitungan = $this->hitungNilaiAkhir(
            $nilaiHarian,
            $nilaiUts,
            $nilaiUas,
            (int) $mapel->id_mapel,
            (int) $validated['id_rapor']
        );

        // Tabel nilai tidak memiliki kolom id_guru.
        $nilai->update([
            'id_siswa' => $validated['id_siswa'],
            'id_rapor' => $validated['id_rapor'],
            'id_mapel' => $mapel->id_mapel,
            'nilai_harian' => $nilaiHarian,
            'nilai_uts' => $nilaiUts,
            'nilai_uas' => $nilaiUas,
            'nilai_akhir' => $hasilPerhitungan['nilai_akhir'],
            'predikat' => $hasilPerhitungan['predikat'],
            'semester' => (int) $validated['semester'],
        ]);

        return redirect()
            ->route('guru.rekap.index')
            ->with('success', 'Nilai berhasil diperbarui.');
    }

    /**
     * HAPUS NILAI
     */
    public function destroy($id)
    {
        $guru = $this->guruLogin();
        $mapel = $this->mapelGuru($guru);

        $kelasDiajar = $this->kelasGuru($guru);
        $namaKelasDiajar = $this->namaKelasGuru($kelasDiajar);

        $nilai = Nilai::where('id_nilai', $id)
            ->where('id_mapel', $mapel->id_mapel)
            ->whereHas('siswa', function ($query) use ($namaKelasDiajar) {
                $this->siswaDiKelasGuru($query, $namaKelasDiajar);
            })
            ->first();

        if (!$nilai) {
            return redirect()
                ->route('guru.rekap.index')
                ->with(
                    'error',
                    'Nilai tidak ditemukan atau bukan bagian dari kelas/mapel yang Anda ajar.'
                );
        }

        $nilai->delete();

        return redirect()
            ->route('guru.rekap.index')
            ->with('success', 'Nilai berhasil dihapus.');
    }
}
