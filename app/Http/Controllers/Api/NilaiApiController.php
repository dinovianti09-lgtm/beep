<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NilaiApiController extends Controller
{
    /**
     * Menampilkan daftar nilai sesuai hak akses pengguna.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->role));

        $query = Nilai::query()
            ->with([
                'siswa:id_siswa,nis,nama_siswa,kelas,user_id',
                'mapel:id_mapel,nama_mapel,kkm',
            ])
            ->select([
                'id_nilai',
                'id_siswa',
                'id_mapel',
                'id_rapor',
                'nilai_harian',
                'nilai_uts',
                'nilai_uas',
                'nilai_akhir',
                'predikat',
                'semester',
            ]);

        // Siswa hanya dapat melihat nilai miliknya sendiri.
        if ($role === 'siswa') {
            $query->whereHas('siswa', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } elseif (!in_array($role, ['admin', 'guru'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses.',
                'data' => null,
            ], 403);
        }

        $nilaiList = $query
            ->orderBy('id_nilai')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data nilai berhasil diambil.',
            'data' => $nilaiList,
        ], 200);
    }

    /**
     * Menampilkan detail nilai sesuai hak akses pengguna.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->role));

        $query = Nilai::query()
            ->with([
                'siswa:id_siswa,nis,nama_siswa,kelas,user_id',
                'mapel:id_mapel,nama_mapel,kkm',
            ])
            ->select([
                'id_nilai',
                'id_siswa',
                'id_mapel',
                'id_rapor',
                'nilai_harian',
                'nilai_uts',
                'nilai_uas',
                'nilai_akhir',
                'predikat',
                'semester',
            ]);

        // Siswa hanya dapat membuka detail nilainya sendiri.
        if ($role === 'siswa') {
            $query->whereHas('siswa', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } elseif (!in_array($role, ['admin', 'guru'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses.',
                'data' => null,
            ], 403);
        }

        $nilai = $query->find($id);

        if (!$nilai) {
            return response()->json([
                'success' => false,
                'message' => 'Data nilai tidak ditemukan atau kamu tidak memiliki akses.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail nilai berhasil diambil.',
            'data' => $nilai,
        ], 200);
    }
}