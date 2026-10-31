<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Nilai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NilaiApiController extends Controller
{
    /**
     * Membuat query dasar nilai.
     */
    private function queryDasar(): \Illuminate\Database\Eloquent\Builder
    {
        return Nilai::query()
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
    }

    /**
     * Membatasi nilai sesuai hak akses pengguna.
     */
    private function batasiAkses(
        Request $request,
        \Illuminate\Database\Eloquent\Builder $query
    ): ?JsonResponse {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna belum terautentikasi.',
                'data' => null,
            ], 401);
        }

        $role = strtolower(trim((string) $user->role));

        // Admin dapat mengakses seluruh nilai.
        if ($role === 'admin') {
            return null;
        }

        // Siswa hanya dapat mengakses nilai miliknya.
        if ($role === 'siswa') {
            $query->whereHas('siswa', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });

            return null;
        }

        // Guru hanya dapat mengakses mapel dan kelas yang ditugaskan.
        if ($role === 'guru') {
            $guru = Guru::where('user_id', $user->id)->first();

            if (!$guru || empty($guru->mapel_diampu)) {
                $query->whereRaw('1 = 0');

                return null;
            }

            $mapel = Mapel::whereRaw(
                'LOWER(TRIM(nama_mapel)) = ?',
                [strtolower(trim($guru->mapel_diampu))]
            )->first();

            if (!$mapel) {
                $query->whereRaw('1 = 0');

                return null;
            }

            $namaKelasDiajar = $guru->kelasDiajar()
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

            $query->where('id_mapel', $mapel->id_mapel);

            if (empty($namaKelasDiajar)) {
                $query->whereRaw('1 = 0');

                return null;
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

            return null;
        }

        return response()->json([
            'success' => false,
            'message' => 'Kamu tidak memiliki akses.',
            'data' => null,
        ], 403);
    }

    /**
     * Menampilkan daftar nilai.
     */
    public function index(Request $request): JsonResponse
    {
        $query = $this->queryDasar();

        $response = $this->batasiAkses($request, $query);

        if ($response !== null) {
            return $response;
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
     * Menampilkan detail nilai.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $query = $this->queryDasar();

        $response = $this->batasiAkses($request, $query);

        if ($response !== null) {
            return $response;
        }

        $nilai = $query->where('id_nilai', $id)->first();

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