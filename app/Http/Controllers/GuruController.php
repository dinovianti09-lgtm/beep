<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Throwable;

class GuruController extends Controller
{
    // ========================================
    // DAFTAR GURU
    // ========================================

    public function index(Request $request)
    {
        $search = trim($request->get('search', ''));

        $guruQuery = Guru::with(['kelasDiajar', 'user'])
            ->orderBy('id_guru', 'desc');

        if ($search !== '') {
            $guruQuery->where(function ($query) use ($search) {
                $query->where('nama_guru', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('mapel_diampu', 'like', '%' . $search . '%');
            });
        }

        $guruList = $guruQuery->get();

        foreach ($guruList as $guru) {
            $user = $guru->user;

            if (!$user || $user->role !== 'guru') {
                $guru->status_akun = 'tanpa akun';
            } else {
                $status = strtolower(trim($user->status ?? 'aktif'));

                $guru->status_akun = $status === 'aktif'
                    ? 'aktif'
                    : 'nonaktif';
            }
        }

        // Menentukan guru yang menjadi wali kelas.
        $waliKelasMap = Kelas::whereNotNull('wali_kelas')
            ->where('wali_kelas', '!=', '')
            ->get(['id', 'nama_kelas', 'wali_kelas'])
            ->groupBy('wali_kelas');

        foreach ($guruList as $guru) {
            $kelasWali = $waliKelasMap->get($guru->nama_guru);

            $guru->status_wali_kelas = $kelasWali
                && $kelasWali->isNotEmpty();

            $guru->nama_kelas_wali = $kelasWali
                ? $kelasWali->pluck('nama_kelas')->implode(', ')
                : null;
        }

        return view(
            'admin.guru.index',
            compact('guruList', 'search')
        );
    }

    // ========================================
    // EXPORT DATA GURU KE EXCEL
    // ========================================

    public function export(Request $request)
    {
        $search = trim($request->get('search', ''));

        $guruQuery = Guru::with('kelasDiajar')
            ->orderBy('id_guru', 'desc');

        if ($search !== '') {
            $guruQuery->where(function ($query) use ($search) {
                $query->where('nama_guru', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('mapel_diampu', 'like', '%' . $search . '%');
            });
        }

        $guruList = $guruQuery->get();

        $data = $guruList->map(function ($guru) {
            return [
                $guru->nip,
                $guru->nama_guru,
                $guru->mapel_diampu,
                $guru->kelasDiajar
                    ->pluck('nama_kelas')
                    ->implode(', '),
            ];
        })->toArray();

        $export = new class($data) implements FromArray, WithHeadings {
            protected array $data;

            public function __construct(array $data)
            {
                $this->data = $data;
            }

            public function headings(): array
            {
                return [
                    'NIP',
                    'Nama Guru',
                    'Mata Pelajaran',
                    'Kelas yang Diajar',
                ];
            }

            public function array(): array
            {
                return $this->data;
            }
        };

        return Excel::download(
            $export,
            'data_guru_' . now()->format('Ymd_His') . '.xlsx'
        );
    }

    // ========================================
    // TAMBAH GURU
    // ========================================

    public function create()
    {
        $mapelList = Mapel::orderBy('nama_mapel', 'asc')->get();
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->get();

        return view(
            'admin.guru.create',
            compact('mapelList', 'kelasList')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => [
                'required',
                'string',
                'max:255',
                'unique:guru,nip',
                'unique:users,username',
            ],
            'nama' => 'required|string|max:255',
            'mapel_diampu' => 'required|string|max:100',
            'kelas_ids' => 'required|array|min:1',
            'kelas_ids.*' => 'integer|exists:kelas,id',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan pada data Guru atau akun pengguna.',
            'nama.required' => 'Nama Guru wajib diisi.',
            'mapel_diampu.required' => 'Mata pelajaran wajib dipilih.',
            'kelas_ids.required' => 'Pilih minimal satu kelas yang diajar.',
            'kelas_ids.min' => 'Pilih minimal satu kelas yang diajar.',
            'kelas_ids.*.exists' => 'Kelas yang dipilih tidak valid.',
        ]);

        DB::transaction(function () use ($validated) {
            $guru = Guru::create([
                'nip' => trim($validated['nip']),
                'nama_guru' => $validated['nama'],
                'mapel_diampu' => $validated['mapel_diampu'],
            ]);

            $guru->kelasDiajar()->sync($validated['kelas_ids']);
        });

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'success',
                'Data Guru berhasil ditambahkan. Guru dapat Register menggunakan NIP yang terdaftar.'
            );
    }

    // ========================================
    // DOWNLOAD TEMPLATE EXCEL
    // ========================================

    public function downloadTemplate()
    {
        $template = new class implements FromArray, WithHeadings {
            public function headings(): array
            {
                return [
                    'nip',
                    'nama_guru',
                    'mapel_diampu',
                    'kelas',
                ];
            }

            public function array(): array
            {
                return [
                    [
                        '19850101201001001',
                        'Andi Setiawan',
                        'Pemrograman Web',
                        'X RPL 1',
                    ],
                    [
                        '19860202201102002',
                        'Siti Amelia',
                        'Bahasa Indonesia',
                        'X RPL 1, XI RPL 1',
                    ],
                ];
            }
        };

        return Excel::download(
            $template,
            'template_data_guru.xlsx'
        );
    }

    // ========================================
    // IMPORT GURU DARI EXCEL
    // ========================================

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ], [
            'file.required' => 'Pilih file Excel terlebih dahulu.',
            'file.mimes' => 'File harus berformat XLSX, XLS, atau CSV.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        $berhasil = 0;
        $gagal = 0;
        $errors = [];

        try {
            $spreadsheet = IOFactory::load(
                $request->file('file')->getRealPath()
            );

            $rows = $spreadsheet->getActiveSheet()
                ->toArray(null, true, true, false);

            if (empty($rows) || count($rows) < 2) {
                $spreadsheet->disconnectWorksheets();

                return back()->with(
                    'error',
                    'File Excel belum memiliki data guru untuk diimpor.'
                );
            }

            $header = array_map(
                fn ($value) => strtolower(trim((string) $value)),
                array_shift($rows)
            );

            $requiredHeaders = [
                'nip',
                'nama_guru',
                'mapel_diampu',
                'kelas',
            ];

            foreach ($requiredHeaders as $requiredHeader) {
                if (!in_array($requiredHeader, $header, true)) {
                    $spreadsheet->disconnectWorksheets();

                    return back()->with(
                        'error',
                        'Kolom Excel harus berisi: nip, nama_guru, mapel_diampu, dan kelas.'
                    );
                }
            }

            if (count($header) !== count(array_unique($header))) {
                $spreadsheet->disconnectWorksheets();

                return back()->with(
                    'error',
                    'Nama kolom Excel tidak boleh ada yang duplikat.'
                );
            }

            $positions = array_flip($header);

            foreach ($rows as $index => $row) {
                $nomorBaris = $index + 2;
                $row = array_pad($row, count($header), null);

                $data = [];

                foreach ($requiredHeaders as $field) {
                    $data[$field] = trim(
                        (string) ($row[$positions[$field]] ?? '')
                    );
                }

                if (
                    $data['nip'] === ''
                    && $data['nama_guru'] === ''
                    && $data['mapel_diampu'] === ''
                    && $data['kelas'] === ''
                ) {
                    continue;
                }

                $validator = Validator::make($data, [
                    'nip' => 'required|string|max:255',
                    'nama_guru' => 'required|string|max:255',
                    'mapel_diampu' => 'required|string|max:100',
                    'kelas' => 'required|string|max:1000',
                ], [
                    'nip.required' => 'NIP wajib diisi.',
                    'nama_guru.required' => 'Nama guru wajib diisi.',
                    'mapel_diampu.required' => 'Mata pelajaran wajib diisi.',
                    'kelas.required' => 'Kelas yang diajar wajib diisi.',
                ]);

                if ($validator->fails()) {
                    $gagal++;

                    $errors[] = [
                        'baris' => $nomorBaris,
                        'pesan' => implode(
                            ' ',
                            $validator->errors()->all()
                        ),
                    ];

                    continue;
                }

                if (
                    Guru::where('nip', $data['nip'])->exists()
                    || User::where('username', $data['nip'])->exists()
                ) {
                    $gagal++;

                    $errors[] = [
                        'baris' => $nomorBaris,
                        'pesan' => 'NIP sudah digunakan oleh guru atau akun pengguna lain.',
                    ];

                    continue;
                }

                $namaKelas = array_values(array_unique(array_filter(
                    array_map(
                        'trim',
                        explode(',', $data['kelas'])
                    ),
                    fn ($nama) => $nama !== ''
                )));

                if (empty($namaKelas)) {
                    $gagal++;

                    $errors[] = [
                        'baris' => $nomorBaris,
                        'pesan' => 'Minimal satu nama kelas harus diisi.',
                    ];

                    continue;
                }

                $kelasDitemukan = Kelas::whereIn(
                    'nama_kelas',
                    $namaKelas
                )->get();

                $namaKelasDitemukan = $kelasDitemukan
                    ->pluck('nama_kelas')
                    ->all();

                $kelasTidakDitemukan = array_diff(
                    $namaKelas,
                    $namaKelasDitemukan
                );

                if (!empty($kelasTidakDitemukan)) {
                    $gagal++;

                    $errors[] = [
                        'baris' => $nomorBaris,
                        'pesan' => 'Kelas tidak ditemukan: '
                            . implode(', ', $kelasTidakDitemukan),
                    ];

                    continue;
                }

                try {
                    DB::transaction(function () use (
                        $data,
                        $kelasDitemukan
                    ) {
                        $guru = Guru::create([
                            'nip' => $data['nip'],
                            'nama_guru' => $data['nama_guru'],
                            'mapel_diampu' => $data['mapel_diampu'],
                        ]);

                        $guru->kelasDiajar()->sync(
                            $kelasDitemukan->pluck('id')->all()
                        );
                    });

                    $berhasil++;
                } catch (Throwable $e) {
                    report($e);

                    $gagal++;

                    $errors[] = [
                        'baris' => $nomorBaris,
                        'pesan' => 'Data gagal disimpan. Periksa struktur database dan log Laravel.',
                    ];
                }
            }

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);

            $pesan = "Import selesai. {$berhasil} guru berhasil ditambahkan.";

            if ($gagal > 0) {
                $pesan .= " {$gagal} baris gagal diimpor.";
            }

            return redirect()
                ->route('admin.guru.index')
                ->with('success', $pesan)
                ->with('import_errors', $errors);
        } catch (Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'File gagal dibaca. Pastikan file Excel sesuai template dan tidak rusak.'
            );
        }
    }

    // ========================================
    // DETAIL GURU
    // ========================================

    public function show($id)
    {
        $guru = Guru::with('kelasDiajar')
            ->where('id_guru', $id)
            ->firstOrFail();

        return view('admin.guru.show', compact('guru'));
    }

    // ========================================
    // EDIT GURU
    // ========================================

    public function edit($id)
    {
        $guru = Guru::with('kelasDiajar')
            ->where('id_guru', $id)
            ->firstOrFail();

        $mapelList = Mapel::orderBy('nama_mapel', 'asc')->get();
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->get();

        $kelasTerpilih = $guru->kelasDiajar
            ->pluck('id')
            ->toArray();

        return view(
            'admin.guru.edit',
            compact(
                'guru',
                'mapelList',
                'kelasList',
                'kelasTerpilih'
            )
        );
    }

    // ========================================
    // UPDATE DATA GURU
    // ========================================

    public function update(Request $request, $id)
    {
        $guru = Guru::where('id_guru', $id)->firstOrFail();

        $validated = $request->validate([
            'nip' => [
                'required',
                'string',
                'max:255',
                'unique:guru,nip,' . $guru->id_guru . ',id_guru',
            ],
            'nama' => 'required|string|max:255',
            'mapel_diampu' => 'required|string|max:100',
            'kelas_ids' => 'required|array|min:1',
            'kelas_ids.*' => 'integer|exists:kelas,id',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Nama Guru wajib diisi.',
            'mapel_diampu.required' => 'Mata pelajaran wajib dipilih.',
            'kelas_ids.required' => 'Pilih minimal satu kelas yang diajar.',
            'kelas_ids.min' => 'Pilih minimal satu kelas yang diajar.',
        ]);

        DB::transaction(function () use ($guru, $validated) {
            $nipBaru = trim($validated['nip']);

            $usernameDipakai = User::where('username', $nipBaru)
                ->where('id', '!=', $guru->user_id ?? 0)
                ->exists();

            if ($usernameDipakai) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'nip' => 'NIP tersebut sudah digunakan sebagai username akun lain.',
                ]);
            }

            $guru->update([
                'nip' => $nipBaru,
                'nama_guru' => $validated['nama'],
                'mapel_diampu' => $validated['mapel_diampu'],
            ]);

            // Jika NIP berubah, username akun yang sudah terhubung ikut diperbarui.
            if ($guru->user_id) {
                $user = User::where('id', $guru->user_id)
                    ->where('role', 'guru')
                    ->first();

                if ($user) {
                    $user->username = $nipBaru;
                    $user->save();
                }
            }

            $guru->kelasDiajar()->sync($validated['kelas_ids']);
        });

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data Guru berhasil diperbarui.');
    }

    // ========================================
    // AKTIFKAN / NONAKTIFKAN AKUN GURU
    // ========================================

    public function toggleStatus($id)
    {
        $guru = Guru::where('id_guru', $id)->firstOrFail();

        if (!$guru->user_id) {
            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Data Guru ini belum terhubung dengan akun pengguna.');
        }

        $user = User::where('id', $guru->user_id)
            ->where('role', 'guru')
            ->first();

        if (!$user) {
            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Akun pengguna Guru tidak ditemukan.');
        }

        $statusSaatIni = strtolower(trim($user->status ?? 'aktif'));

        $statusBaru = $statusSaatIni === 'aktif'
            ? 'nonaktif'
            : 'aktif';

        DB::transaction(function () use ($user, $statusBaru) {
            $user->status = $statusBaru;
            $user->save();
        });

        $pesan = $statusBaru === 'aktif'
            ? 'Akun Guru berhasil diaktifkan kembali.'
            : 'Akun Guru berhasil dinonaktifkan. Data Guru dan data akademiknya tetap disimpan.';

        return redirect()
            ->route('admin.guru.index')
            ->with('success', $pesan);
    }

    // ========================================
    // RESET PASSWORD AKUN GURU
    // ========================================

    public function resetPassword($id)
    {
        $guru = Guru::where('id_guru', $id)->firstOrFail();

        if (!$guru->user_id) {
            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Data Guru ini belum terhubung dengan akun pengguna.');
        }

        $user = User::where('id', $guru->user_id)
            ->where('role', 'guru')
            ->first();

        if (!$user) {
            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Akun Guru tidak ditemukan.');
        }

        // Password sementara hanya menggunakan huruf dan angka.
        $passwordSementara = Str::upper(Str::random(4))
            . random_int(1000, 9999)
            . Str::lower(Str::random(2));

        DB::transaction(function () use ($user, $passwordSementara) {
            // Model User otomatis melakukan hashing pada password.
            $user->password = $passwordSementara;
            $user->must_change_password = true;
            $user->save();
        });

        return redirect()
            ->route('admin.guru.index')
            ->with('reset_password_result', [
                'nama' => $guru->nama_guru,
                'nip' => $guru->nip,
                'password' => $passwordSementara,
            ]);
    }

    // ========================================
    // HAPUS GURU
    // ========================================

    public function destroy($id)
    {
        $guru = Guru::where('id_guru', $id)->firstOrFail();

        DB::transaction(function () use ($guru) {
            $userId = $guru->user_id;
            $namaGuru = $guru->nama_guru;

            $guru->kelasDiajar()->detach();

            Kelas::where('wali_kelas', $namaGuru)
                ->update(['wali_kelas' => null]);

            $guru->delete();

            if ($userId) {
                User::where('id', $userId)
                    ->where('role', 'guru')
                    ->delete();
            }
        });

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'success',
                'Data Guru dan akun login berhasil dihapus.'
            );
    }
}
