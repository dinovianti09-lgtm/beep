<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Rapor;
use App\Models\RaporSiswa;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\IOFactory;

class NilaiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HEADER EXCEL
    |--------------------------------------------------------------------------
    */

    private function headingExcel(): array
    {
        return [
            'NIS',
            'Nama Siswa',
            'Kelas',
            'Mata Pelajaran',
            'Semester',
            'Tahun Ajaran',
            'Nilai Harian',
            'Nilai UTS',
            'Nilai UAS',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | HAK AKSES ADMIN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403
        );

        $kelasList = Kelas::orderBy('nama_kelas')->get();
        $mapelList = Mapel::orderBy('nama_mapel')->get();

        $kelasTerpilih = $request->get('kelas');
        $semesterTerpilih = $request->get('semester');
        $mapelTerpilih = $request->get('mapel');

        $nilaiList = $this->queryNilaiAdmin($request)->get();

        return view('admin.nilai.index', compact(
            'kelasList',
            'mapelList',
            'kelasTerpilih',
            'semesterTerpilih',
            'mapelTerpilih',
            'nilaiList'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY DATA NILAI ADMIN
    |--------------------------------------------------------------------------
    */

    private function queryNilaiAdmin(Request $request)
    {
        $nilaiQuery = Nilai::with(['siswa', 'mapel', 'rapor'])
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('semester', 1)
                        ->whereHas('rapor', function ($raporQuery) {
                            $raporQuery->whereRaw(
                                'LOWER(TRIM(semester)) = ?',
                                ['ganjil']
                            );
                        });
                })->orWhere(function ($q) {
                    $q->where('semester', 2)
                        ->whereHas('rapor', function ($raporQuery) {
                            $raporQuery->whereRaw(
                                'LOWER(TRIM(semester)) = ?',
                                ['genap']
                            );
                        });
                });
            })
            ->orderByDesc('id_nilai');

        $kelasTerpilih = $request->get('kelas');
        $semesterTerpilih = $request->get('semester');
        $mapelTerpilih = $request->get('mapel');

        if (!empty($kelasTerpilih)) {
            $namaKelas = strtolower(str_replace(
                '-',
                ' ',
                trim($kelasTerpilih)
            ));

            $nilaiQuery->whereHas('siswa', function ($query) use ($namaKelas) {
                $query->whereRaw(
                    "LOWER(REPLACE(TRIM(kelas), '-', ' ')) = ?",
                    [$namaKelas]
                );
            });
        }

        if (in_array((string) $semesterTerpilih, ['1', '2'], true)) {
            $nilaiQuery->where('semester', (int) $semesterTerpilih);
        }

        if (!empty($mapelTerpilih)) {
            $nilaiQuery->where('id_mapel', (int) $mapelTerpilih);
        }

        return $nilaiQuery;
    }

    /*
    |--------------------------------------------------------------------------
    | DATA GURU DAN BATAS KELAS/MAPEL
    |--------------------------------------------------------------------------
    */

    private function konteksGuru(): array
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'guru',
            403
        );

        $guru = Guru::where('user_id', auth()->id())->first();

        abort_if(
            !$guru,
            403,
            'Data Guru untuk akun ini belum ditemukan.'
        );

        if (empty($guru->mapel_diampu)) {
            abort(403, 'Mapel yang diampu belum ditentukan Admin.');
        }

        $mapel = Mapel::whereRaw(
            'LOWER(TRIM(nama_mapel)) = ?',
            [strtolower(trim($guru->mapel_diampu))]
        )->first();

        abort_if(
            !$mapel,
            403,
            'Mapel yang diampu tidak ditemukan.'
        );

        $kelasDiajar = $guru->kelasDiajar()
            ->orderBy('nama_kelas')
            ->get();

        $namaKelasDiajar = $kelasDiajar
            ->pluck('nama_kelas')
            ->map(function ($nama) {
                return strtolower(str_replace(
                    '-',
                    ' ',
                    trim((string) $nama)
                ));
            })
            ->filter()
            ->unique()
            ->values()
            ->all();

        return [
            'guru' => $guru,
            'mapel' => $mapel,
            'kelasDiajar' => $kelasDiajar,
            'namaKelasDiajar' => $namaKelasDiajar,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | CEK APAKAH SISWA TERMASUK KELAS YANG DIAJAR GURU
    |--------------------------------------------------------------------------
    */

    private function siswaTermasukKelasGuru(
        Siswa $siswa,
        array $namaKelasDiajar
    ): bool {
        $kelasSiswa = strtolower(str_replace(
            '-',
            ' ',
            trim((string) $siswa->kelas)
        ));

        return in_array($kelasSiswa, $namaKelasDiajar, true);
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY NILAI GURU
    |--------------------------------------------------------------------------
    */

    private function queryNilaiGuru(
        Request $request,
        Mapel $mapel,
        array $namaKelasDiajar
    ) {
        $query = Nilai::with(['siswa', 'mapel', 'rapor'])
            ->where('id_mapel', $mapel->id_mapel)
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('semester', 1)
                        ->whereHas('rapor', function ($raporQuery) {
                            $raporQuery->whereRaw(
                                'LOWER(TRIM(semester)) = ?',
                                ['ganjil']
                            );
                        });
                })->orWhere(function ($sub) {
                    $sub->where('semester', 2)
                        ->whereHas('rapor', function ($raporQuery) {
                            $raporQuery->whereRaw(
                                'LOWER(TRIM(semester)) = ?',
                                ['genap']
                            );
                        });
                });
            })
            ->orderByDesc('id_nilai');

        if (empty($namaKelasDiajar)) {
            $query->whereRaw('1 = 0');

            return $query;
        }

        $query->whereHas('siswa', function ($siswaQuery) use ($namaKelasDiajar) {
            $siswaQuery->where(function ($kelasQuery) use ($namaKelasDiajar) {
                foreach ($namaKelasDiajar as $namaKelas) {
                    $kelasQuery->orWhereRaw(
                        "LOWER(REPLACE(TRIM(kelas), '-', ' ')) = ?",
                        [$namaKelas]
                    );
                }
            });
        });

        $kelasTerpilih = $request->get('kelas');
        $semesterTerpilih = $request->get('semester');

        if (!empty($kelasTerpilih)) {
            $namaKelas = strtolower(str_replace(
                '-',
                ' ',
                trim($kelasTerpilih)
            ));

            if (!in_array($namaKelas, $namaKelasDiajar, true)) {
                $query->whereRaw('1 = 0');
            } else {
                $query->whereHas('siswa', function ($siswaQuery) use ($namaKelas) {
                    $siswaQuery->whereRaw(
                        "LOWER(REPLACE(TRIM(kelas), '-', ' ')) = ?",
                        [$namaKelas]
                    );
                });
            }
        }

        if (in_array((string) $semesterTerpilih, ['1', '2'], true)) {
            $query->where('semester', (int) $semesterTerpilih);
        }

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPLATE EXCEL GURU
    |--------------------------------------------------------------------------
    */

    public function downloadTemplate()
    {
        $this->konteksGuru();

        $export = new class($this->headingExcel()) implements FromArray, WithHeadings {
            private array $headings;

            public function __construct(array $headings)
            {
                $this->headings = $headings;
            }

            public function array(): array
            {
                return [];
            }

            public function headings(): array
            {
                return $this->headings;
            }
        };

        return Excel::download(
            $export,
            'template_import_nilai.xlsx'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL GURU
    |--------------------------------------------------------------------------
    */

    public function export(Request $request)
    {
        $konteks = $this->konteksGuru();

        $nilaiList = $this->queryNilaiGuru(
            $request,
            $konteks['mapel'],
            $konteks['namaKelasDiajar']
        )->get();

        $rows = $nilaiList->map(function ($nilai) {
            return [
                $nilai->siswa->nis ?? '',
                $nilai->siswa->nama_siswa ?? '',
                $nilai->siswa->kelas ?? '',
                $nilai->mapel->nama_mapel ?? '',
                $this->jenisSemester($nilai->rapor->semester ?? '') === 1
                    ? 'Ganjil'
                    : 'Genap',
                $nilai->rapor->tahun_ajaran ?? '',
                $nilai->nilai_harian,
                $nilai->nilai_uts,
                $nilai->nilai_uas,
            ];
        })->values()->all();

        $export = new class($rows, $this->headingExcel()) implements FromArray, WithHeadings {
            private array $rows;
            private array $headings;

            public function __construct(array $rows, array $headings)
            {
                $this->rows = $rows;
                $this->headings = $headings;
            }

            public function array(): array
            {
                return $this->rows;
            }

            public function headings(): array
            {
                return $this->headings;
            }
        };

        return Excel::download(
            $export,
            'data_nilai_guru_' . now()->format('Ymd_His') . '.xlsx'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | IMPORT EXCEL GURU
    |--------------------------------------------------------------------------
    */

    public function import(Request $request)
    {
        $konteks = $this->konteksGuru();

        $guruMapel = $konteks['mapel'];
        $namaKelasDiajar = $konteks['namaKelasDiajar'];

        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ], [
            'file.required' => 'Pilih file Excel yang akan diimpor.',
            'file.mimes' => 'File harus berformat XLSX, XLS, atau CSV.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        try {
            $spreadsheet = IOFactory::load(
                $request->file('file')->getRealPath()
            );

            $sheetRows = $spreadsheet
                ->getActiveSheet()
                ->toArray(null, true, true, true);
        } catch (\Throwable $e) {
            return back()->withErrors([
                'file' => 'File Excel tidak bisa dibaca. Periksa format file.',
            ]);
        }

        if (empty($sheetRows)) {
            return back()->withErrors([
                'file' => 'File Excel masih kosong.',
            ]);
        }

        $headerRow = reset($sheetRows);

        $headerAktual = array_map(
            fn ($value) => strtolower(trim((string) $value)),
            array_values($headerRow)
        );

        $headerWajib = array_map(
            fn ($value) => strtolower(trim($value)),
            $this->headingExcel()
        );

        if ($headerAktual !== $headerWajib) {
            return back()->withErrors([
                'file' => 'Format kolom tidak sesuai. Gunakan Template Excel Nilai dari halaman Guru.',
            ]);
        }

        $jumlahBerhasil = 0;
        $jumlahDilewati = 0;
        $errors = [];

        $barisPertama = array_key_first($sheetRows);

        foreach ($sheetRows as $nomorBaris => $row) {
            if ((string) $nomorBaris === (string) $barisPertama) {
                continue;
            }

            $values = [];

            foreach (range('A', 'I') as $column) {
                $values[] = trim((string) ($row[$column] ?? ''));
            }

            if (count(array_filter(
                $values,
                fn ($value) => $value !== ''
            )) === 0) {
                continue;
            }

            [
                $nis,
                $namaSiswa,
                $kelas,
                $namaMapel,
                $semesterText,
                $tahunAjaran,
                $nilaiHarian,
                $nilaiUts,
                $nilaiUas,
            ] = $values;

            $nomorExcel = $nomorBaris;

            if (is_numeric($nis)) {
                $nis = (string) (int) $nis;
            }

            $pesanError = [];

            if (
                $nis === '' ||
                $namaSiswa === '' ||
                $kelas === '' ||
                $namaMapel === '' ||
                $semesterText === '' ||
                $tahunAjaran === '' ||
                $nilaiHarian === '' ||
                $nilaiUts === '' ||
                $nilaiUas === ''
            ) {
                $pesanError[] = 'Ada kolom wajib yang masih kosong.';
            }

            $semester = $this->jenisSemester($semesterText);

            if ($semester === null) {
                $pesanError[] = 'Semester harus Ganjil atau Genap.';
            }

            foreach ([
                'Nilai Harian' => $nilaiHarian,
                'Nilai UTS' => $nilaiUts,
                'Nilai UAS' => $nilaiUas,
            ] as $label => $nilai) {
                if (
                    $nilai !== '' &&
                    (
                        !is_numeric($nilai) ||
                        (float) $nilai < 0 ||
                        (float) $nilai > 100
                    )
                ) {
                    $pesanError[] = $label .
                        ' harus berupa angka 0 sampai 100.';
                }
            }

            if (!empty($pesanError)) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel . ': ' .
                    implode(' ', $pesanError);
                continue;
            }

            // Cari siswa berdasarkan NIS.
            $siswa = Siswa::where('nis', $nis)->first();

            if (!$siswa) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': NIS ' . $nis . ' tidak ditemukan.';
                continue;
            }

            // Pastikan nama siswa sesuai dengan NIS.
            if (
                strtolower(trim((string) $siswa->nama_siswa)) !==
                strtolower(trim($namaSiswa))
            ) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': Nama siswa tidak sesuai dengan NIS ' . $nis . '.';
                continue;
            }

            // Pastikan kelas pada Excel cocok dengan kelas siswa.
            $kelasExcel = strtolower(str_replace(
                '-',
                ' ',
                trim($kelas)
            ));

            $kelasDatabase = strtolower(str_replace(
                '-',
                ' ',
                trim((string) $siswa->kelas)
            ));

            if ($kelasExcel !== $kelasDatabase) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': Kelas tidak sesuai dengan data siswa ' .
                    $siswa->nama_siswa . '.';
                continue;
            }

            // Pastikan siswa berasal dari kelas yang diajar Guru.
            if (!$this->siswaTermasukKelasGuru(
                $siswa,
                $namaKelasDiajar
            )) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': Siswa ' . $siswa->nama_siswa .
                    ' bukan dari kelas yang Anda ajar.';
                continue;
            }

            // Pastikan mapel Excel sesuai dengan mapel Guru.
            $namaMapelExcel = strtolower(trim($namaMapel));
            $namaMapelGuru = strtolower(trim($guruMapel->nama_mapel));

            if ($namaMapelExcel !== $namaMapelGuru) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': Mapel harus ' . $guruMapel->nama_mapel . '.';
                continue;
            }

            // Cari periode rapor yang sesuai.
            $rapor = Rapor::where(
                'tahun_ajaran',
                $tahunAjaran
            )->get()->first(function ($item) use ($semester) {
                return $this->jenisSemester($item->semester) === $semester;
            });

            if (!$rapor) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': Periode rapor semester ' . $semesterText .
                    ' tahun ajaran ' . $tahunAjaran .
                    ' tidak ditemukan.';
                continue;
            }

            // Cegah nilai ganda.
            $nilaiSudahAda = Nilai::where(
                'id_siswa',
                $siswa->id_siswa
            )
                ->where('id_mapel', $guruMapel->id_mapel)
                ->where('id_rapor', $rapor->id_rapor)
                ->where('semester', $semester)
                ->exists();

            if ($nilaiSudahAda) {
                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': Nilai siswa ' . $siswa->nama_siswa .
                    ' untuk mapel dan periode tersebut sudah ada.';
                continue;
            }

            $dataNilai = [
                'id_siswa' => $siswa->id_siswa,
                'id_mapel' => $guruMapel->id_mapel,
                'id_rapor' => $rapor->id_rapor,
                'semester' => $semester,
                'nilai_harian' => (float) $nilaiHarian,
                'nilai_uts' => (float) $nilaiUts,
                'nilai_uas' => (float) $nilaiUas,
            ];

            $this->hitungNilaiAkhir($dataNilai);

            try {
                DB::transaction(function () use ($dataNilai) {
                    // Simpan nilai.
                    Nilai::create($dataNilai);

                    // Buat rapor siswa jika belum ada.
                    RaporSiswa::firstOrCreate(
                        [
                            'id_siswa' => $dataNilai['id_siswa'],
                            'id_rapor' => $dataNilai['id_rapor'],
                        ],
                        [
                            'tgl_cetak' => now()->toDateString(),
                            'file_pdf' => null,
                        ]
                    );
                });

                $jumlahBerhasil++;
            } catch (\Throwable $e) {
                report($e);

                $jumlahDilewati++;
                $errors[] = 'Baris ' . $nomorExcel .
                    ': Gagal menyimpan nilai atau membuat data rapor.';
            }
        }

        $pesan = 'Import selesai. Berhasil: ' . $jumlahBerhasil .
            ' baris. Dilewati: ' . $jumlahDilewati . ' baris.';

        return back()
            ->with('success', $pesan)
            ->with('import_errors', array_slice($errors, 0, 30));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM INPUT NILAI GURU
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'guru',
            403
        );

        $guru = Guru::where('user_id', auth()->id())->first();

        if (!$guru) {
            return redirect()
                ->route('guru.dashboard')
                ->withErrors([
                    'guru' => 'Data Guru untuk akun ini belum ditemukan.',
                ]);
        }

        if (empty($guru->mapel_diampu)) {
            return redirect()
                ->route('guru.dashboard')
                ->withErrors([
                    'guru' => 'Mapel yang diampu belum ditentukan oleh Admin.',
                ]);
        }

        $mapel = Mapel::whereRaw(
            'LOWER(TRIM(nama_mapel)) = ?',
            [strtolower(trim($guru->mapel_diampu))]
        )->first();

        if (!$mapel) {
            return redirect()
                ->route('guru.dashboard')
                ->withErrors([
                    'guru' => 'Mapel yang diampu tidak ditemukan di Data Mapel.',
                ]);
        }

        $kelasDiajar = $guru->kelasDiajar()
            ->orderBy('nama_kelas')
            ->get();

        $namaKelasDiajar = $kelasDiajar
            ->pluck('nama_kelas')
            ->map(function ($nama) {
                return str_replace('-', ' ', trim($nama));
            })
            ->toArray();

        $siswaList = collect();

        if (!empty($namaKelasDiajar)) {
            $siswaList = Siswa::whereNotNull('kelas')
                ->where(function ($query) use ($namaKelasDiajar) {
                    foreach ($namaKelasDiajar as $namaKelas) {
                        $query->orWhereRaw(
                            "REPLACE(TRIM(kelas), '-', ' ') = ?",
                            [$namaKelas]
                        );
                    }
                })
                ->orderBy('nama_siswa')
                ->get();
        }

        $raporList = Rapor::orderByDesc('id_rapor')->get();

        $kelasTerpilih = $request->get(
            'id_kelas',
            old('id_kelas', '')
        );

        return view('guru.nilai.create', compact(
            'siswaList',
            'raporList',
            'guru',
            'mapel',
            'kelasDiajar',
            'kelasTerpilih'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN NILAI GURU SECARA MANUAL
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'guru',
            403
        );

        $guru = Guru::where('user_id', auth()->id())->first();

        if (!$guru) {
            return back()
                ->withErrors([
                    'guru' => 'Data Guru untuk akun ini belum ditemukan.',
                ])
                ->withInput();
        }

        if (empty($guru->mapel_diampu)) {
            return back()
                ->withErrors([
                    'guru' => 'Mapel yang diampu belum ditentukan oleh Admin.',
                ])
                ->withInput();
        }

        $mapel = Mapel::whereRaw(
            'LOWER(TRIM(nama_mapel)) = ?',
            [strtolower(trim($guru->mapel_diampu))]
        )->first();

        if (!$mapel) {
            return back()
                ->withErrors([
                    'guru' => 'Mapel yang diampu tidak ditemukan.',
                ])
                ->withInput();
        }

        $validated = $request->validate([
            'id_kelas' => 'required|integer|exists:kelas,id',
            'id_siswa' => 'required|integer|exists:siswa,id_siswa',
            'id_rapor' => 'required|integer|exists:rapor,id_rapor',
            'nilai_harian' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
            'semester' => 'required|integer|in:1,2',
        ]);

        $kelasValid = $guru->kelasDiajar()
            ->where('kelas.id', $validated['id_kelas'])
            ->exists();

        if (!$kelasValid) {
            return back()
                ->withErrors([
                    'id_kelas' => 'Kelas tersebut bukan kelas yang Anda ajar.',
                ])
                ->withInput();
        }

        $kelas = Kelas::where(
            'id',
            $validated['id_kelas']
        )->firstOrFail();

        $namaKelas = strtolower(str_replace(
            '-',
            ' ',
            trim($kelas->nama_kelas)
        ));

        $siswaValid = Siswa::where(
            'id_siswa',
            $validated['id_siswa']
        )
            ->whereRaw(
                "LOWER(REPLACE(TRIM(kelas), '-', ' ')) = ?",
                [$namaKelas]
            )
            ->exists();

        if (!$siswaValid) {
            return back()
                ->withErrors([
                    'id_siswa' => 'Siswa tidak sesuai dengan kelas yang dipilih.',
                ])
                ->withInput();
        }

        $rapor = Rapor::where(
            'id_rapor',
            $validated['id_rapor']
        )->firstOrFail();

        $jenisRapor = $this->jenisSemester($rapor->semester);

        if (
            $jenisRapor === null ||
            (int) $validated['semester'] !== $jenisRapor
        ) {
            return back()
                ->withErrors([
                    'id_rapor' => 'Semester tidak cocok dengan periode rapor yang dipilih.',
                ])
                ->withInput();
        }

        if (empty($rapor->tahun_ajaran)) {
            return back()
                ->withErrors([
                    'id_rapor' => 'Tahun ajaran pada rapor belum ditentukan.',
                ])
                ->withInput();
        }

        $nilaiSudahAda = Nilai::where(
            'id_siswa',
            $validated['id_siswa']
        )
            ->where('id_mapel', $mapel->id_mapel)
            ->where('id_rapor', $validated['id_rapor'])
            ->where('semester', $validated['semester'])
            ->exists();

        if ($nilaiSudahAda) {
            return back()
                ->withErrors([
                    'id_siswa' => 'Nilai siswa untuk mapel dan periode rapor tersebut sudah ada.',
                ])
                ->withInput();
        }

        unset($validated['id_kelas']);

        $validated['id_mapel'] = $mapel->id_mapel;

        $this->hitungNilaiAkhir($validated);

        // Simpan nilai dan rapor siswa dalam satu transaksi.
        DB::transaction(function () use ($validated) {
            Nilai::create($validated);

            // Tidak membuat rapor baru jika sudah tersedia.
            RaporSiswa::firstOrCreate(
                [
                    'id_siswa' => $validated['id_siswa'],
                    'id_rapor' => $validated['id_rapor'],
                ],
                [
                    'tgl_cetak' => now()->toDateString(),
                    'file_pdf' => null,
                ]
            );
        });

        return redirect()
            ->route('guru.rekap.index')
            ->with('success', 'Nilai berhasil ditambahkan dan rapor siswa dipastikan tersedia.');
    }

    /*
    |--------------------------------------------------------------------------
    | JENIS SEMESTER
    |--------------------------------------------------------------------------
    */

    private function jenisSemester($semester): ?int
    {
        $semester = strtolower(trim((string) $semester));

        if (in_array($semester, ['ganjil', '1'], true)) {
            return 1;
        }

        if (in_array($semester, ['genap', '2'], true)) {
            return 2;
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG NILAI AKHIR DAN PREDIKAT
    |--------------------------------------------------------------------------
    */

    private function hitungNilaiAkhir(array &$validated): void
    {
        $harian = (float) $validated['nilai_harian'];
        $uts = (float) $validated['nilai_uts'];
        $uas = (float) $validated['nilai_uas'];

        $nilaiAkhir = ($harian * 0.30)
            + ($uts * 0.30)
            + ($uas * 0.40);

        $validated['nilai_akhir'] = round($nilaiAkhir, 2);

        if ($nilaiAkhir >= 90) {
            $validated['predikat'] = 'A';
        } elseif ($nilaiAkhir >= 80) {
            $validated['predikat'] = 'B';
        } elseif ($nilaiAkhir >= 70) {
            $validated['predikat'] = 'C';
        } else {
            $validated['predikat'] = 'D';
        }
    }
}
