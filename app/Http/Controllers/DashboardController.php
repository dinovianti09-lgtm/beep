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

        // Rekap jumlah siswa per kelas
        $rekapSiswaPerKelas = Siswa::select('kelas')
            ->selectRaw('COUNT(*) as jumlah_siswa')
            ->groupBy('kelas')
            ->orderBy('kelas')
            ->get();

        // Data guru dan siswa terbaru
        $guruList = Guru::orderBy('id_guru', 'desc')
            ->take(5)
            ->get();

        $siswaList = Siswa::orderBy('id_siswa', 'desc')
            ->take(5)
            ->get();

        // Identitas admin
        $namaSiswa = $user->username ?? 'Admin';
        $inisial = strtoupper(substr($namaSiswa, 0, 2));

        // =========================
        // FILTER SEMESTER
        // =========================

        $semesterAkademik = request('semester_akademik', '');

        if (!in_array($semesterAkademik, ['1', '2'])) {
            $semesterAkademik = '';
        }

        // Statistik bulanan mengikuti filter akademik
        $semesterBulanan = $semesterAkademik;

        // Query nilai berdasarkan semester
        $queryAkademik = Nilai::query()
            ->whereNotNull('nilai_akhir');

        if ($semesterAkademik !== '') {
            $queryAkademik->where(
                'semester',
                $semesterAkademik
            );
        }

        // Rata-rata seluruh nilai
        $avgNilai = (clone $queryAkademik)
            ->avg('nilai_akhir') ?? 0;

        // =========================
        // STATISTIK NILAI BULANAN
        // =========================

        $tahunNilaiTerpilih = (int) request(
            'tahun_nilai',
            now()->year
        );

        if (
            $tahunNilaiTerpilih < 2000 ||
            $tahunNilaiTerpilih > 2100
        ) {
            $tahunNilaiTerpilih = now()->year;
        }

        // Tahun yang tersedia
        $tahunNilaiTersedia = Nilai::whereNotNull('created_at')
            ->selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->map(fn ($tahun) => (int) $tahun)
            ->push(now()->year)
            ->push($tahunNilaiTerpilih)
            ->unique()
            ->sortDesc()
            ->values();

        // Data nilai berdasarkan bulan dan semester
        $queryBulanan = Nilai::whereYear(
            'created_at',
            $tahunNilaiTerpilih
        )->whereNotNull('nilai_akhir');

        if ($semesterBulanan !== '') {
            $queryBulanan->where(
                'semester',
                $semesterBulanan
            );
        }

        $dataNilaiBulanan = $queryBulanan
            ->selectRaw('MONTH(created_at) as bulan')
            ->selectRaw('AVG(nilai_akhir) as rata_rata')
            ->selectRaw('COUNT(*) as jumlah')
            ->groupByRaw('MONTH(created_at)')
            ->get()
            ->keyBy('bulan');

        // Nama bulan
        $namaBulan = [
            1 => ['Jan', 'Januari'],
            2 => ['Feb', 'Februari'],
            3 => ['Mar', 'Maret'],
            4 => ['Apr', 'April'],
            5 => ['Mei', 'Mei'],
            6 => ['Jun', 'Juni'],
            7 => ['Jul', 'Juli'],
            8 => ['Agu', 'Agustus'],
            9 => ['Sep', 'September'],
            10 => ['Okt', 'Oktober'],
            11 => ['Nov', 'November'],
            12 => ['Des', 'Desember'],
        ];

        // Lengkapi semua bulan
        $statistikNilaiBulanan = collect(range(1, 12))
            ->map(function ($bulan) use (
                $dataNilaiBulanan,
                $namaBulan
            ) {
                $data = $dataNilaiBulanan->get($bulan);

                return [
                    'bulan' => $namaBulan[$bulan][0],
                    'bulan_panjang' => $namaBulan[$bulan][1],
                    'rata_rata' => $data
                        ? (float) $data->rata_rata
                        : null,
                    'jumlah' => $data
                        ? (int) $data->jumlah
                        : 0,
                ];
            });

        // =========================
        // RATA-RATA NILAI PER MAPEL
        // =========================

        $rataRataPerMapel = Mapel::orderBy('nama_mapel')
            ->get()
            ->map(function ($mapel) use ($semesterAkademik) {

                $query = Nilai::where(
                    'id_mapel',
                    $mapel->id_mapel
                )->whereNotNull('nilai_akhir');

                if ($semesterAkademik !== '') {
                    $query->where(
                        'semester',
                        $semesterAkademik
                    );
                }

                $mapel->rata_rata_nilai = $query
                    ->avg('nilai_akhir');

                return $mapel;
            });

        // Jumlah mapel yang sudah memiliki nilai
        $totalMapelDinilai = (clone $queryAkademik)
            ->distinct()
            ->count('id_mapel');

        // 5 nilai terbaru berdasarkan semester
$queryNilaiTerbaru = Nilai::with([
    'siswa',
    'mapel'
]);

if ($semesterAkademik !== '') {
    $queryNilaiTerbaru->where(
        'semester',
        $semesterAkademik
    );
}

$nilaiTerbaru = $queryNilaiTerbaru
    ->orderBy('id_nilai', 'desc')
    ->take(5)
    ->get();
        return view('admin.dashboard', compact(
            'jumlahGuru',
            'jumlahSiswa',
            'jumlahKelas',
            'jumlahMapel',
            'rekapSiswaPerKelas',
            'guruList',
            'siswaList',
            'namaSiswa',
            'inisial',
            'avgNilai',
            'totalMapelDinilai',
            'nilaiTerbaru',
            'rataRataPerMapel',
            'tahunNilaiTerpilih',
            'tahunNilaiTersedia',
            'statistikNilaiBulanan',
            'semesterAkademik',
            'semesterBulanan'
        ));
    }

    // =========================
    // DASHBOARD GURU
    // =========================

    public function guru()
    {
        $user = Auth::user();

        $guru = Guru::where(
            'user_id',
            $user->id
        )->first();

        if (!$guru) {
            Auth::logout();

            return redirect()
                ->route('login')
                ->withErrors([
                    'username' =>
                        'Data Guru untuk akun ini belum ditemukan.',
                ]);
        }

        // Data wali kelas
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

        // Mata pelajaran guru
        $mapel = null;

        if (!empty($guru->mapel_diampu)) {
            $mapel = Mapel::whereRaw(
                'LOWER(TRIM(nama_mapel)) = ?',
                [strtolower(trim($guru->mapel_diampu))]
            )->first();
        }

        // Kelas yang diajar
        $kelasDiajar = $guru->kelasDiajar()
            ->orderBy('nama_kelas')
            ->get();

        // Filter kelas berdasarkan mapel
        if ($mapel) {
            $pengaturanMapel = $mapel
                ->pengaturanKelas()
                ->get(['tingkat', 'jurusan']);

            $kelasDiajar = $kelasDiajar
                ->filter(function ($kelas) use (
                    $pengaturanMapel
                ) {
                    $bagian = preg_split(
                        '/\s+/',
                        strtoupper(trim($kelas->nama_kelas))
                    );

                    $tingkat = $bagian[0] ?? '';
                    $jurusan = $bagian[1] ?? '';

                    return $pengaturanMapel->contains(
                        function ($pengaturan) use (
                            $tingkat,
                            $jurusan
                        ) {
                            return
                                $pengaturan->tingkat === $tingkat &&
                                $pengaturan->jurusan === $jurusan;
                        }
                    );
                })
                ->values();
        } else {
            $kelasDiajar = collect();
        }

        $jumlahKelasDiajar = $kelasDiajar->count();

        return view('guru.dashboard', compact(
            'guru',
            'kelasWali',
            'siswaWali',
            'jumlahSiswaWali',
            'mapel',
            'kelasDiajar',
            'jumlahKelasDiajar'
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
                    substr($user->username, 0, 2)
                ),
                'nilaiTerbaru' => collect(),
                'avgNilai' => 0,
                'totalMapelDinilai' => 0,
                'semesterTerpilih' => $semesterTerpilih,
            ]);
        }

        
$queryNilai = Nilai::with('mapel')
    ->where('id_siswa', $siswa->id_siswa)
    ->where('status_persetujuan', 'published')
    ->whereNotNull('nilai_akhir')
    ->whereHas('mapel', function ($query) {
        $query->whereNotNull('kkm')
            ->whereRaw('nilai.nilai_akhir < mapel.kkm');
    });


        if (in_array($semesterTerpilih, ['1', '2'])) {
            $queryNilai->where(
                'semester',
                $semesterTerpilih
            );
        }

        $nilaiTerbaru = (clone $queryNilai)
            ->orderBy('id_nilai', 'desc')
            ->take(5)
            ->get();

        $avgNilai = (clone $queryNilai)
            ->avg('nilai_akhir') ?? 0;

        $totalMapelDinilai = (clone $queryNilai)
            ->distinct()
            ->count('id_mapel');

        $namaSiswa = $siswa->nama_siswa;

        $inisial = strtoupper(
            substr($namaSiswa, 0, 2)
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
