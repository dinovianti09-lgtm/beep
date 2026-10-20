<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    /**
     * Login API:
     * Admin menggunakan username.
     * Guru menggunakan NIP.
     * Siswa menggunakan NIS.
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'role' => ['required', 'string', 'in:admin,guru,siswa'],
            'identity' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $role = strtolower(trim($credentials['role']));
        $identity = trim($credentials['identity']);
        $password = $credentials['password'];

        /*
         * Cari akun berdasarkan role dan identitas.
         */
        if ($role === 'admin') {
            $user = User::query()
                ->where('role', 'admin')
                ->where('username', $identity)
                ->first();
        } elseif ($role === 'guru') {
            $user = User::query()
                ->where('role', 'guru')
                ->whereHas('guru', function ($query) use ($identity) {
                    $query->where('nip', $identity);
                })
                ->first();
        } else {
            $user = User::query()
                ->where('role', 'siswa')
                ->whereHas('siswa', function ($query) use ($identity) {
                    $query->where('nis', $identity);
                })
                ->first();
        }

        /*
         * Periksa akun dan password.
         */
        if (
            !$user ||
            !Hash::check($password, $user->password)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Identitas atau password salah.',
            ], 401);
        }

        $userRole = strtolower(trim((string) $user->role));
        $status = strtolower(trim((string) $user->status));

        /*
         * Pastikan role sesuai dan diizinkan.
         */
        if (!in_array($userRole, ['admin', 'guru', 'siswa'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Role akun tidak diizinkan mengakses API.',
            ], 403);
        }

        if ($userRole !== $role) {
            return response()->json([
                'success' => false,
                'message' => 'Role login tidak sesuai dengan akun.',
            ], 403);
        }

        /*
         * Guru dan siswa harus memiliki akun aktif.
         */
        if (
            in_array($userRole, ['guru', 'siswa'], true) &&
            $status !== 'aktif'
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Akun kamu sedang nonaktif. Silakan hubungi Admin sekolah.',
            ], 403);
        }

        /*
         * Password harus diganti melalui website terlebih dahulu.
         */
        if ($user->must_change_password) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu harus mengganti password melalui website terlebih dahulu.',
            ], 403);
        }

        /*
         * Buat token akses Sanctum.
         */
        $token = $user->createToken(
            'sistem-akademik-api'
        )->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login API berhasil.',
            'token_type' => 'Bearer',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $userRole,
                'status' => $status,
            ],
        ], 200);
    }

    /**
     * Logout dan hapus token yang sedang digunakan.
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        $token = $user?->currentAccessToken();

        if ($token && method_exists($token, 'delete')) {
            $token->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout API berhasil.',
        ], 200);
    }
}
