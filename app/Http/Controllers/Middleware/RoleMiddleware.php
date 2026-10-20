$kode = @'
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

        if (
            in_array($role, ['guru', 'siswa'], true) &&
            $status !== 'aktif'
        ) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'username' => 'Akun kamu sedang nonaktif. Silakan hubungi Admin sekolah.',
                ]);
        }

        if (!in_array($role, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
'@

Set-Content -Path .\app\Http\Middleware\RoleMiddleware.php -Value $kode -Encoding utf8

Get-Content .\app\Http\Middleware\RoleMiddleware.php