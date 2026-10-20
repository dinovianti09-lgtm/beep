<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GuruApiController extends Controller
{
    /**
     * Menampilkan daftar guru sesuai hak akses.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->role));

        $query = Guru::query()
            ->select([
                'id_guru',
                'user_id',
                'nip',
                'nama_guru',
                'mapel_diampu',
            ]);

        if ($role === 'guru') {
            $query->where('user_id', $user->id);
        } elseif ($role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke data guru.',
                'data' => null,
            ], 403);
        }

        $guruList = $query
            ->orderBy('nama_guru')
            ->get()
            ->makeHidden('user_id');

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil diambil.',
            'data' => $guruList,
        ], 200);
    }

    /**
     * Menampilkan detail guru sesuai hak akses.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->role));

        $query = Guru::query()
            ->select([
                'id_guru',
                'user_id',
                'nip',
                'nama_guru',
                'mapel_diampu',
            ]);

        if ($role === 'guru') {
            $query->where('user_id', $user->id);
        } elseif ($role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke data guru.',
                'data' => null,
            ], 403);
        }

        $guru = $query->find($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan atau kamu tidak memiliki akses.',
                'data' => null,
            ], 404);
        }

        $guru->makeHidden('user_id');

        return response()->json([
            'success' => true,
            'message' => 'Detail guru berhasil diambil.',
            'data' => $guru,
        ], 200);
    }
}