<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Nilai;
use App\Models\RaporSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Throwable;

class SiswaController extends Controller
{
    // ========================================
    // DAFTAR SISWA
    // ========================================

    public function index(Request $request)
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();

        $search = trim((string) $request->query('search', ''));
        $kelasTerpilih = trim((string) $request->query('kelas', ''));

        $query = Siswa::with('user')
            ->orderBy('nama_siswa');

        // FILTER KELAS
        if ($kelasTerpilih !== '') {
            $query->where('kelas', $kelasTerpilih);
        }

        // PENCARIAN NAMA, NIS, ATAU KELAS
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        // PAGINATION 10 SISWA PER HALAMAN
        // Parameter pencarian dan filter tetap dibawa saat pindah halaman.
        $siswaList = $query
            ->paginate(10)
            ->withQueryString();

        // MENENTUKAN STATUS AKUN SISWA
        foreach ($siswaList as $siswa) {
            $user = $siswa->user;

            if (!$user || $user->role !== 'siswa') {
                $siswa->status_akun = 'tanpa akun';
            } else {
                $status = strtolower(trim($user->status ?? 'aktif'));

                $siswa->status_akun = $status === 'aktif'
                    ? 'aktif'
                    : 'nonaktif';
            }
        }

        return view('admin.siswa.index', [
            'siswaList' => $siswaList,
            'kelasList' => $kelasList,
            'kelasTerpilih' => $kelasTerpilih,
            'search' => $search,
        ]);
    }

    // ========================================
    // EXPORT DATA SISWA KE EXCEL
    // ========================================

    public function export(Request $request)
    {
        $query = Siswa::query()
            ->orderBy('nama_siswa');

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        // Export tetap mengambil seluruh hasil filter,
        // bukan hanya 10 data pada halaman aktif.
        $siswaList = $query->get();

        $data = $siswaList->map(function ($siswa) {
            return [
                $siswa->nis,
                $siswa->nama_siswa,
                $siswa->kelas,
                $siswa->jenis_kelamin,
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
                    'NIS',
                    'Nama Siswa',
                    'Kelas',
                    'Jenis Kelamin',
                ];
            }

            public function array(): array
            {
                return $this->data;
            }
        };

        return Excel::download(
            $export,
            'data_siswa_' . now()->format('Ymd_His') . '.xlsx'
        );
    }

    // ========================================
    // TAMBAH SISWA
    // ========================================

    public function create()
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();

        return view('admin.siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:30|unique:siswa,nis',
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
        ]);

        try {
            Siswa::create($validated);

            return redirect()
                ->route('admin.siswa.index')
                ->with(
                    'success',
                    'Data siswa berhasil ditambahkan. Siswa dapat Register menggunakan NIS yang terdaftar.'
                );
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Data siswa gagal ditambahkan. Periksa kembali data dan struktur database.'
                );
        }
    }

    // ========================================
    // DOWNLOAD TEMPLATE EXCEL
    // ========================================

    public function downloadTemplate()
    {
        $export = new class implements FromArray, WithHeadings {
            public function headings(): array
            {
                return [
                    'nis',
                    'nama_siswa',
                    'kelas',
                    'jenis_kelamin',
                ];
            }

            public function array(): array
            {
                return [
                    ['10001', 'Contoh Nama Siswa', 'X RPL 1', 'L'],
                ];
            }
        };

        return Excel::download($export, 'template_siswa.xlsx');
    }

    // ========================================
    // IMPORT SISWA DARI EXCEL
    // ========================================

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ], [
            'file.required' => 'Pilih file Excel terlebih dahulu.',
            'file.mimes' => 'File harus berformat XLSX, XLS, atau CSV.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $file = $request->file('file');

            $spreadsheet = IOFactory::load($file->getRealPath());

            $rows = $spreadsheet
                ->getActiveSheet()
                ->toArray(null, true, true, true);

            if (count($rows) < 2) {
                $spreadsheet->disconnectWorksheets();

                return back()->with(
                    'error',
                    'File Excel belum berisi data siswa.'
                );
            }

            $headerRow = array_shift($rows);
            $headers = [];

            foreach ($headerRow as $column => $header) {
                $key = strtolower(trim((string) $header));

                if ($key !== '') {
                    if (in_array($key, $headers, true)) {
                        $spreadsheet->disconnectWorksheets();

                        return back()->with(
                            'error',
                            'Ada nama kolom yang duplikat di file Excel: ' . $key
                        );
                    }

                    $headers[$key] = $column;
                }
            }

            $requiredHeaders = [
                'nis',
                'nama_siswa',
                'kelas',
                'jenis_kelamin',
            ];

            foreach ($requiredHeaders as $requiredHeader) {
                if (!array_key_exists($requiredHeader, $headers)) {
                    $spreadsheet->disconnectWorksheets();

                    return back()->with(
                        'error',
                        'Kolom ' . $requiredHeader .
                        ' tidak ditemukan. Gunakan file template siswa.'
                    );
                }
            }

            $berhasil = 0;
            $dilewati = 0;
            $importErrors = [];

            DB::transaction(function () use (
                $rows,
                $headers,
                &$berhasil,
                &$dilewati,
                &$importErrors
            ) {
                foreach ($rows as $index => $row) {
                    $nomorBaris = $index + 2;

                    $nis = trim(
                        (string) ($row[$headers['nis']] ?? '')
                    );

                    $nama = trim(
                        (string) ($row[$headers['nama_siswa']] ?? '')
                    );

                    $kelas = trim(
                        (string) ($row[$headers['kelas']] ?? '')
                    );

                    $jenisKelamin = strtoupper(
                        trim(
                            (string) ($row[$headers['jenis_kelamin']] ?? '')
                        )
                    );

                    if (
                        $nis === '' &&
                        $nama === '' &&
                        $kelas === '' &&
                        $jenisKelamin === ''
                    ) {
                        continue;
                    }

                    $rowValidator = Validator::make([
                        'nis' => $nis,
                        'nama_siswa' => $nama,
                        'kelas' => $kelas,
                        'jenis_kelamin' => $jenisKelamin,
                    ], [
                        'nis' => 'required|string|max:30',
                        'nama_siswa' => 'required|string|max:255',
                        'kelas' => 'required|string|max:100',
                        'jenis_kelamin' => 'required|in:L,P',
                    ]);

                    if ($rowValidator->fails()) {
                        $dilewati++;

                        $importErrors[] = 'Baris ' . $nomorBaris . ': '
                            . implode(' ', $rowValidator->errors()->all());

                        continue;
                    }

                    if (Siswa::where('nis', $nis)->exists()) {
                        $dilewati++;

                        $importErrors[] = 'Baris ' . $nomorBaris
                            . ': NIS ' . $nis . ' sudah terdaftar.';

                        continue;
                    }

                    Siswa::create([
                        'nis' => $nis,
                        'nama_siswa' => $nama,
                        'kelas' => $kelas,
                        'jenis_kelamin' => $jenisKelamin,
                    ]);

                    $berhasil++;
                }
            });

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);

            $message = "Import selesai. {$berhasil} data berhasil ditambahkan.";

            if ($dilewati > 0) {
                $message .= " {$dilewati} baris dilewati.";
            }

            return redirect()
                ->route('admin.siswa.index')
                ->with('success', $message)
                ->with('import_errors', $importErrors);
        } catch (Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Import gagal. Periksa format file Excel dan pastikan kolomnya sesuai template.'
            );
        }
    }

    // ========================================
    // DETAIL SISWA
    // ========================================

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('admin.siswa.show', compact('siswa'));
    }

    // ========================================
    // EDIT SISWA
    // ========================================

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        $kelasList = Kelas::orderBy('nama_kelas')->get();

        return view('admin.siswa.edit', compact('siswa', 'kelasList'));
    }

    // ========================================
    // UPDATE DATA SISWA
    // ========================================

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nis' => 'required|string|max:30|unique:siswa,nis,'
                . $siswa->id_siswa . ',id_siswa',
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan.',
            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
        ]);

        try {
            DB::transaction(function () use ($siswa, $validated) {
                $nisBaru = trim($validated['nis']);

                // Pastikan NIS tidak digunakan sebagai username akun lain.
                if ($siswa->user_id) {
                    $usernameDipakai = User::where('username', $nisBaru)
                        ->where('id', '!=', $siswa->user_id)
                        ->exists();
                } else {
                    $usernameDipakai = User::where(
                        'username',
                        $nisBaru
                    )->exists();
                }

                if ($usernameDipakai) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'nis' => 'NIS tersebut sudah digunakan sebagai username akun lain.',
                    ]);
                }

                $siswa->update([
                    'nis' => $nisBaru,
                    'nama_siswa' => $validated['nama_siswa'],
                    'kelas' => $validated['kelas'],
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                ]);

                // Jika NIS berubah, username akun yang terhubung ikut berubah.
                if ($siswa->user_id) {
                    $user = User::where('id', $siswa->user_id)
                        ->where('role', 'siswa')
                        ->first();

                    if ($user) {
                        $user->username = $nisBaru;
                        $user->save();
                    }
                }
            });

            return redirect()
                ->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Data siswa gagal diperbarui.');
        }
    }

    // ========================================
    // AKTIFKAN / NONAKTIFKAN AKUN SISWA
    // ========================================

    public function toggleStatus($id)
    {
        $siswa = Siswa::findOrFail($id);

        if (!$siswa->user_id) {
            return redirect()
                ->route('admin.siswa.index')
                ->with(
                    'error',
                    'Siswa belum memiliki akun. Siswa perlu Register terlebih dahulu.'
                );
        }

        $user = User::where('id', $siswa->user_id)
            ->where('role', 'siswa')
            ->first();

        if (!$user) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Akun siswa tidak ditemukan.');
        }

        $statusSaatIni = strtolower(trim($user->status ?? 'aktif'));

        $user->status = $statusSaatIni === 'aktif'
            ? 'nonaktif'
            : 'aktif';

        $user->save();

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Status akun siswa berhasil diperbarui menjadi '
                    . $user->status . '.'
            );
    }

    // ========================================
    // RESET PASSWORD AKUN SISWA
    // ========================================

    public function resetPassword($id)
    {
        $siswa = Siswa::findOrFail($id);

        if (!$siswa->user_id) {
            return redirect()
                ->route('admin.siswa.index')
                ->with(
                    'error',
                    'Siswa ini belum memiliki akun. Minta siswa Register terlebih dahulu.'
                );
        }

        $user = User::where('id', $siswa->user_id)
            ->where('role', 'siswa')
            ->first();

        if (!$user) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Akun siswa tidak ditemukan.');
        }

        // Password sementara hanya menggunakan huruf dan angka.
        $passwordSementara = Str::upper(Str::random(4))
            . random_int(1000, 9999)
            . Str::lower(Str::random(2));

        DB::transaction(function () use ($user, $passwordSementara) {
            // Model User otomatis melakukan hashing password.
            $user->password = $passwordSementara;
            $user->must_change_password = true;

            // Status akun tidak diubah.
            $user->save();
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('reset_password_result', [
                'nama' => $siswa->nama_siswa,
                'nis' => $siswa->nis,
                'password' => $passwordSementara,
            ]);
    }

    // ========================================
    // HAPUS SISWA
    // ========================================

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        if (Nilai::where('id_siswa', $siswa->id_siswa)->exists()) {
            return redirect()
                ->route('admin.siswa.index')
                ->with(
                    'error',
                    'Data siswa tidak dapat dihapus karena masih memiliki data nilai.'
                );
        }

        if (RaporSiswa::where('id_siswa', $siswa->id_siswa)->exists()) {
            return redirect()
                ->route('admin.siswa.index')
                ->with(
                    'error',
                    'Data siswa tidak dapat dihapus karena masih memiliki data rapor.'
                );
        }

        try {
            DB::transaction(function () use ($siswa) {
                $siswa->user_id = null;
                $siswa->save();

                $siswa->delete();

                // Akun pengguna tetap dipertahankan.
            });

            return redirect()
                ->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil dihapus.');
        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa gagal dihapus.');
        }
    }
}