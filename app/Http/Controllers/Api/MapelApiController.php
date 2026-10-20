<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapelApiController extends Controller
{
    /**
     * Menampilkan daftar mata pelajaran.
     * Hanya pengguna yang sudah login yang dapat mengaksesnya.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->role));

        if (!in_array($role, ['admin', 'guru', 'siswa'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses.',
                'data' => null,
            ], 403);
        }

        $mapelList = Mapel::query()
            ->select([
                'id_mapel',
                'nama_mapel',
                'kkm',
            ])
            ->orderBy('nama_mapel')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data mata pelajaran berhasil diambil.',
            'data' => $mapelList,
        ], 200);
    }

    /**
     * Menampilkan detail mata pelajaran.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->role));

        if (!in_array($role, ['admin', 'guru', 'siswa'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses.',
                'data' => null,
            ], 403);
        }

        $mapel = Mapel::query()
            ->select([
                'id_mapel',
                'nama_mapel',
                'kkm',
            ])
            ->find($id);

        if (!$mapel) {
            return response()->json([
                'success' => false,
                'message' => 'Data mata pelajaran tidak ditemukan.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail mata pelajaran berhasil diambil.',
            'data' => $mapel,
        ], 200);
    }
}