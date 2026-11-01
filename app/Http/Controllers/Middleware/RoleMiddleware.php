<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = User::find(Auth::id());

        if (!$user) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }

        $role = strtolower(trim((string) $user->role));
        $status = strtolower(trim((string) $user->status));

        // Tolak akun guru/siswa yang sedang nonaktif.
        if (
            in_array($role, ['guru', 'siswa'], true) &&
            $status !== 'aktif'
        ) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'username' => 'Akun kamu sedang nonaktif. Silakan hubungi Admin sekolah.',
            ]);
        }

        // Pastikan role pengguna sesuai dengan akses halaman.
        $allowedRoles = array_map(
            fn ($item) => strtolower(trim((string) $item)),
            $roles
        );

        if (!in_array($role, $allowedRoles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Wajib ganti password sebelum membuka halaman lain.
        if (
            in_array($role, ['guru', 'siswa'], true) &&
            $user->must_change_password &&
            !in_array($request->route()->getName(), [
                'password.force-change',
                'password.force-change.process',
            ], true)
        ) {
            return redirect()->route('password.force-change');
        }

        return $next($request);
    }
}
