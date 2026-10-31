<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiswaApiController extends Controller
{
    /**
     * Membuat query siswa sesuai hak akses pengguna.
     */
    private function querySesuaiAkses(Request $request): Builder|JsonResponse
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->role));

        $query = Siswa::query()
            ->select([
                'id_siswa',
                'user_id',
                'nis',
                'nama_siswa',
                'kelas',
                'jenis_kelamin',
            ]);

        // Admin dapat melihat semua siswa.
        if ($role === 'admin') {
            return $query;
        }

        // Siswa hanya dapat melihat datanya sendiri.
        if ($role === 'siswa') {
            return $query->where('user_id', $user->id);
        }

        // Guru hanya dapat melihat siswa dari kelas yang diajar.
        if ($role === 'guru') {
            $guru = Guru::with('kelasDiajar')
                ->where('user_id', $user->id)
                ->first();

            if (!$guru) {
                return $query->whereRaw('1 = 0');
            }

            $daftarKelas = $guru->kelasDiajar
                ->pluck('nama_kelas')
                ->filter()
                ->map(fn ($kelas) => mb_strtolower(trim($kelas)))
                ->unique()
                ->values()
                ->all();

            if (empty($daftarKelas)) {
                return $query->whereRaw('1 = 0');
            }

            return $query->whereIn(
                \DB::raw('LOWER(TRIM(kelas))'),
                $daftarKelas
            );
        }

        return response()->json([
            'success' => false,
            'message' => 'Kamu tidak memiliki akses.',
            'data' => null,
        ], 403);
    }

    /**
     * Menampilkan daftar siswa sesuai hak akses.
     */
    public function index(Request $request): JsonResponse
    {
        $query = $this->querySesuaiAkses($request);

        if ($query instanceof JsonResponse) {
            return $query;
        }

        $siswaList = $query
            ->orderBy('nama_siswa')
            ->get()
            ->makeHidden('user_id');

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diambil.',
            'data' => $siswaList,
        ], 200);
    }

    /**
     * Menampilkan detail siswa berdasarkan ID sesuai hak akses.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $query = $this->querySesuaiAkses($request);

        if ($query instanceof JsonResponse) {
            return $query;
        }

        $siswa = $query->find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan atau kamu tidak memiliki akses.',
                'data' => null,
            ], 404);
        }

        $siswa->makeHidden('user_id');

        return response()->json([
            'success' => true,
            'message' => 'Detail siswa berhasil diambil.',
            'data' => $siswa,
        ], 200);
    }
}
