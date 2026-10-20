<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar kelas.
     */
    public function index(Request $request)
    {
        $query = Kelas::query();

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('nama_kelas', 'like', '%' . $search . '%')
                    ->orWhere('tingkat', 'like', '%' . $search . '%')
                    ->orWhere('jurusan', 'like', '%' . $search . '%')
                    ->orWhere('wali_kelas', 'like', '%' . $search . '%');
            });
        }

        $kelasList = $query
            ->orderBy('tingkat')
            ->orderBy('jurusan')
            ->orderBy('nama_kelas')
            ->get();

        return view('admin.kelas.index', compact('kelasList'));
    }

    /**
     * Form tambah kelas.
     */
    public function create()
    {
        $guruList = Guru::orderBy('nama_guru')->get();

        $kelasWaliMap = Kelas::whereNotNull('wali_kelas')
            ->where('wali_kelas', '!=', '')
            ->get()
            ->keyBy('wali_kelas');

        foreach ($guruList as $guru) {
            $guru->kelas_wali_dipakai = $kelasWaliMap->get(
                $guru->nama_guru
            );
        }

        return view('admin.kelas.create', compact('guruList'));
    }

    /**
     * Menyimpan kelas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tingkat' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'jurusan' => ['required', Rule::in(['RPL', 'DKV', 'BR'])],
            'nomor_kelas' => ['required', 'integer', 'min:1', 'max:20'],
            'wali_kelas' => [
                'nullable',
                'string',
                'max:100',
                'exists:guru,nama_guru',
                Rule::unique('kelas', 'wali_kelas'),
            ],
        ], [
            'tingkat.required' => 'Tingkat kelas wajib dipilih.',
            'tingkat.in' => 'Tingkat kelas tidak valid.',
            'jurusan.required' => 'Jurusan wajib dipilih.',
            'jurusan.in' => 'Jurusan tidak valid. Pilih RPL, DKV, atau BR.',
            'nomor_kelas.required' => 'Nomor kelas wajib diisi.',
            'nomor_kelas.integer' => 'Nomor kelas harus berupa angka.',
            'nomor_kelas.min' => 'Nomor kelas minimal 1.',
            'nomor_kelas.max' => 'Nomor kelas maksimal 20.',
            'wali_kelas.exists' => 'Guru yang dipilih tidak ditemukan di Data Guru.',
            'wali_kelas.unique' => 'Guru tersebut sudah menjadi wali kelas di kelas lain.',
        ]);

        $namaKelas = $validated['tingkat'] . ' '
            . $validated['jurusan'] . ' '
            . $validated['nomor_kelas'];

        if (Kelas::where('nama_kelas', $namaKelas)->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'nomor_kelas' => 'Kelas ' . $namaKelas . ' sudah tersedia.',
                ]);
        }

        Kelas::create([
            'nama_kelas' => $namaKelas,
            'tingkat' => $validated['tingkat'],
            'jurusan' => $validated['jurusan'],
            'wali_kelas' => $validated['wali_kelas'] ?? null,
        ]);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas ' . $namaKelas . ' berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kelas.
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('admin.kelas.show', compact('kelas'));
    }

    /**
     * Form edit kelas.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        $nomorKelas = 1;

        if (preg_match('/[- ](\d+)$/', $kelas->nama_kelas, $matches)) {
            $nomorKelas = (int) $matches[1];
        }

        $guruList = Guru::orderBy('nama_guru')->get();

        $kelasWaliMap = Kelas::whereNotNull('wali_kelas')
            ->where('wali_kelas', '!=', '')
            ->where('id', '!=', $id)
            ->get()
            ->keyBy('wali_kelas');

        foreach ($guruList as $guru) {
            $guru->kelas_wali_dipakai = $kelasWaliMap->get(
                $guru->nama_guru
            );
        }

        /*
         * Penyesuaian data lama:
         * Jika kelas masih menyimpan jurusan BRP,
         * tampilkan pilihan BR pada form edit.
         * Perubahan di database dilakukan saat form disimpan.
         */
        if ($kelas->jurusan === 'BRP') {
            $kelas->jurusan = 'BR';
        }

        return view(
            'admin.kelas.edit',
            compact('kelas', 'nomorKelas', 'guruList')
        );
    }

    /**
     * Memperbarui kelas.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'tingkat' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'jurusan' => ['required', Rule::in(['RPL', 'DKV', 'BR'])],
            'nomor_kelas' => ['required', 'integer', 'min:1', 'max:20'],
            'wali_kelas' => [
                'nullable',
                'string',
                'max:100',
                'exists:guru,nama_guru',
                Rule::unique('kelas', 'wali_kelas')->ignore($id, 'id'),
            ],
        ], [
            'tingkat.required' => 'Tingkat kelas wajib dipilih.',
            'tingkat.in' => 'Tingkat kelas tidak valid.',
            'jurusan.required' => 'Jurusan wajib dipilih.',
            'jurusan.in' => 'Jurusan tidak valid. Pilih RPL, DKV, atau BR.',
            'nomor_kelas.required' => 'Nomor kelas wajib diisi.',
            'nomor_kelas.integer' => 'Nomor kelas harus berupa angka.',
            'nomor_kelas.min' => 'Nomor kelas minimal 1.',
            'nomor_kelas.max' => 'Nomor kelas maksimal 20.',
            'wali_kelas.exists' => 'Guru yang dipilih tidak ditemukan di Data Guru.',
            'wali_kelas.unique' => 'Guru tersebut sudah menjadi wali kelas di kelas lain.',
        ]);

        $namaKelasBaru = $validated['tingkat'] . ' '
            . $validated['jurusan'] . ' '
            . $validated['nomor_kelas'];

        $kelasSudahAda = Kelas::where('nama_kelas', $namaKelasBaru)
            ->where('id', '!=', $id)
            ->exists();

        if ($kelasSudahAda) {
            return back()
                ->withInput()
                ->withErrors([
                    'nomor_kelas' => 'Kelas ' . $namaKelasBaru . ' sudah digunakan.',
                ]);
        }

        DB::transaction(function () use ($kelas, $validated, $namaKelasBaru) {
            $namaKelasLama = $kelas->nama_kelas;

            // Menjaga hubungan siswa ketika nama kelas berubah.
            if ($namaKelasLama !== $namaKelasBaru) {
                Siswa::where('kelas', $namaKelasLama)
                    ->update([
                        'kelas' => $namaKelasBaru,
                    ]);
            }

            $kelas->update([
                'nama_kelas' => $namaKelasBaru,
                'tingkat' => $validated['tingkat'],
                'jurusan' => $validated['jurusan'],
                'wali_kelas' => $validated['wali_kelas'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.kelas.index')
            ->with(
                'success',
                'Data kelas berhasil diperbarui menjadi ' . $namaKelasBaru . '.'
            );
    }

    /**
     * Menghapus kelas jika tidak memiliki siswa.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $jumlahSiswa = Siswa::where('kelas', $kelas->nama_kelas)->count();

        if ($jumlahSiswa > 0) {
            return redirect()
                ->route('admin.kelas.index')
                ->with(
                    'error',
                    'Kelas ' . $kelas->nama_kelas
                    . ' tidak dapat dihapus karena masih memiliki '
                    . $jumlahSiswa
                    . ' siswa. Pindahkan siswa ke kelas lain terlebih dahulu.'
                );
        }

        $kelas->delete();

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}
