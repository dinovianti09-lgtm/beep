<?php

namespace App\Http\Controllers;

use App\Models\EkstrakurikulerSiswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KehadiranSiswa;
use App\Models\Rapor;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruRaporTambahanController extends Controller
{
    /**
     * Memastikan guru adalah wali kelas siswa yang dipilih.
     */
    private function validasiWaliKelas(
        Request $request,
        int $idSiswa,
        int $idRapor
    ): void {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'guru',
            403,
            'Akses hanya untuk guru.'
        );

        $guru = Guru::where('user_id', $user->id)->first();

        abort_unless($guru, 403, 'Data guru tidak ditemukan.');

        $kelasWali = Kelas::where(
            'wali_kelas',
            $guru->nama_guru
        )->first();

        abort_unless(
            $kelasWali,
            403,
            'Kelas wali tidak ditemukan.'
        );

        $siswa = Siswa::where('id_siswa', $idSiswa)->firstOrFail();

        abort_unless(
            trim((string) $siswa->kelas) ===
                trim((string) $kelasWali->nama_kelas),
            403,
            'Kamu hanya bisa mengubah data siswa di kelas wali kamu.'
        );

        Rapor::where('id_rapor', $idRapor)->firstOrFail();
    }

    /**
     * Simpan atau perbarui rekap kehadiran siswa.
     */
    public function simpanKehadiran(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => [
                'required',
                'integer',
                'exists:siswa,id_siswa',
            ],
            'id_rapor' => [
                'required',
                'integer',
                'exists:rapor,id_rapor',
            ],
            'sakit' => ['required', 'integer', 'min:0', 'max:366'],
            'izin' => ['required', 'integer', 'min:0', 'max:366'],
            'tanpa_keterangan' => [
                'required',
                'integer',
                'min:0',
                'max:366',
            ],
        ]);

        $this->validasiWaliKelas(
            $request,
            (int) $validated['id_siswa'],
            (int) $validated['id_rapor']
        );

        KehadiranSiswa::updateOrCreate(
            [
                'id_siswa' => $validated['id_siswa'],
                'id_rapor' => $validated['id_rapor'],
            ],
            [
                'sakit' => $validated['sakit'],
                'izin' => $validated['izin'],
                'tanpa_keterangan' => $validated['tanpa_keterangan'],
            ]
        );

        return back()->with(
            'success',
            'Data kehadiran berhasil disimpan.'
        );
    }

    /**
     * Simpan daftar ekstrakurikuler siswa.
     * Minimal satu nama kegiatan wajib diisi.
     */
    public function simpanEkstrakurikuler(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => [
                'required',
                'integer',
                'exists:siswa,id_siswa',
            ],
            'id_rapor' => [
                'required',
                'integer',
                'exists:rapor,id_rapor',
            ],
            'ekstrakurikuler' => ['required', 'array', 'min:1', 'max:20'],
            'ekstrakurikuler.*.nama' => [
                'nullable',
                'string',
                'max:100',
            ],
            'ekstrakurikuler.*.predikat' => [
                'nullable',
                'string',
                'in:Sangat Baik,Baik,Cukup Baik,Kurang',
            ],
            'ekstrakurikuler.*.keterangan' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $this->validasiWaliKelas(
            $request,
            (int) $validated['id_siswa'],
            (int) $validated['id_rapor']
        );

        $daftar = collect($validated['ekstrakurikuler'])
            ->map(function ($item) {
                return [
                    'nama_ekstrakurikuler' => trim($item['nama'] ?? ''),
                    'predikat' => trim($item['predikat'] ?? ''),
                    'keterangan' => trim($item['keterangan'] ?? ''),
                ];
            })
            ->filter(function ($item) {
                return $item['nama_ekstrakurikuler'] !== '';
            })
            ->values();

        // Tolak jika semua nama kegiatan kosong.
        // Data lama tidak disentuh.
        if ($daftar->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'ekstrakurikuler' =>
                        'Minimal harus mengisi satu nama ekstrakurikuler.',
                ]);
        }

        DB::transaction(function () use ($validated, $daftar) {
            EkstrakurikulerSiswa::where(
                'id_siswa',
                $validated['id_siswa']
            )
                ->where('id_rapor', $validated['id_rapor'])
                ->delete();

            foreach ($daftar as $item) {
                EkstrakurikulerSiswa::create([
                    'id_siswa' => $validated['id_siswa'],
                    'id_rapor' => $validated['id_rapor'],
                    'nama_ekstrakurikuler' =>
                        $item['nama_ekstrakurikuler'],
                    'predikat' =>
                        $item['predikat'] !== ''
                            ? $item['predikat']
                            : null,
                    'keterangan' =>
                        $item['keterangan'] !== ''
                            ? $item['keterangan']
                            : null,
                ]);
            }
        });

        return back()->with(
            'success',
            'Data ekstrakurikuler berhasil disimpan.'
        );
    }
}
