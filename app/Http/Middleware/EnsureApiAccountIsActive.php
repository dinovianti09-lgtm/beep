<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.',
                'data' => null,
            ], 401);
        }

        // Ambil kondisi akun terbaru dari database.
        $user->refresh();

        $role = strtolower(trim((string) $user->role));
        $status = strtolower(trim((string) $user->status));

        // Tolak role yang tidak dikenal.
        if (!in_array($role, ['admin', 'guru', 'siswa'], true)) {
            $user->currentAccessToken()?->delete();

            return response()->json([
                'success' => false,
                'message' => 'Role akun tidak diizinkan.',
            ], 403);
        }

        // Tolak akun guru dan siswa nonaktif.
        if (
            in_array($role, ['guru', 'siswa'], true) &&
            $status !== 'aktif'
        ) {
            $user->currentAccessToken()?->delete();

            return response()->json([
                'success' => false,
                'message' => 'Akun sedang nonaktif. Silakan hubungi Admin.',
            ], 403);
        }

        // Tolak akun yang wajib mengganti password.
        if (
            in_array($role, ['guru', 'siswa'], true) &&
            $user->must_change_password
        ) {
            $user->currentAccessToken()?->delete();

            return response()->json([
                'success' => false,
                'message' => 'Silakan ganti password melalui website terlebih dahulu.',
            ], 403);
        }

        return $next($request);
    }
}
