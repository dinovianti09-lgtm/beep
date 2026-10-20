<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiswaApiController extends Controller
{
    /**
     * Menampilkan daftar siswa sesuai hak akses pengguna.
     */
    public function index(Request $request): JsonResponse
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

        // Admin dan guru dapat melihat daftar siswa.
        // Siswa hanya dapat melihat data miliknya sendiri.
        if ($role === 'siswa') {
            $query->where('user_id', $user->id);
        } elseif (!in_array($role, ['admin', 'guru'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses.',
                'data' => null,
            ], 403);
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
     * Menampilkan detail siswa berdasarkan ID.
     */
    public function show(Request $request, string $id): JsonResponse
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

        // Siswa hanya dapat membuka detail dirinya sendiri.
        if ($role === 'siswa') {
            $query->where('user_id', $user->id);
        } elseif (!in_array($role, ['admin', 'guru'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses.',
                'data' => null,
            ], 403);
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
