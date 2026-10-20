<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['required', 'in:admin,guru,siswa'],
        ]);

        $user = User::where('username', $validated['username'])
            ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()
                ->withInput($request->only('username', 'role'))
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ]);
        }

        if ($user->role !== $validated['role']) {
            return back()
                ->withInput($request->only('username', 'role'))
                ->withErrors([
                    'role' => 'Role yang dipilih tidak sesuai dengan akun.',
                ]);
        }

        if (in_array($user->role, ['guru', 'siswa'], true)) {
            if (strtolower((string) $user->status) !== 'aktif') {
                return back()
                    ->withInput($request->only('username', 'role'))
                    ->withErrors([
                        'username' => 'Akun kamu sedang nonaktif. Hubungi Admin.',
                    ]);
            }

            if ($user->role === 'guru') {
                $profilAda = Guru::where('user_id', $user->id)->exists();
            } else {
                $profilAda = Siswa::where('user_id', $user->id)->exists();
            }

            if (!$profilAda) {
                return back()
                    ->withInput($request->only('username', 'role'))
                    ->withErrors([
                        'username' => 'Data profil akun tidak ditemukan. Hubungi Admin.',
                    ]);
            }
        }

        Auth::login($user);
        $request->session()->regenerate();

        if (
            in_array($user->role, ['guru', 'siswa'], true)
            && $user->must_change_password
        ) {
            return redirect()->route('password.force-change');
        }

        return $this->redirectToDashboard($user->role);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'role' => ['required', 'in:guru,siswa'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ],
        ], [
            'role.required' => 'Silakan pilih role akun.',
            'role.in' => 'Register hanya tersedia untuk Guru dan Siswa.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        /*
         * Mendukung nama input identitas yang umum digunakan.
         * Sesuaikan dengan nama input pada halaman Register jika diperlukan.
         */
        $identifier = trim((string) (
            $request->input('identifier')
            ?? $request->input('nip')
            ?? $request->input('nis')
            ?? $request->input('username')
            ?? ''
        ));

        if ($identifier === '') {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'identifier' => 'NIP atau NIS wajib diisi.',
                ]);
        }

        $role = $request->input('role');

        if ($role === 'guru') {
            $profil = Guru::where('nip', $identifier)->first();
            $jenisIdentitas = 'NIP';
        } else {
            $profil = Siswa::where('nis', $identifier)->first();
            $jenisIdentitas = 'NIS';
        }

        if (!$profil) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'identifier' => $jenisIdentitas .
                        ' tidak ditemukan. Pastikan data sudah dimasukkan Admin.',
                ]);
        }

        if ($profil->user_id) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'identifier' => 'Data ini sudah terhubung ke akun. Silakan login atau hubungi Admin jika lupa password.',
                ]);
        }

        if (User::where('username', $identifier)->exists()) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'identifier' => 'Identitas ini sudah digunakan sebagai username.',
                ]);
        }

        try {
            DB::transaction(function () use (
                $identifier,
                $role,
                $profil,
                $request
            ) {
                /*
                 * Model User menggunakan cast hashed,
                 * sehingga password akan di-hash secara otomatis.
                 */
                $user = User::create([
                    'username' => $identifier,
                    'password' => $request->input('password'),
                    'role' => $role,
                    'status' => 'aktif',
                    'must_change_password' => false,
                    'activation_token_hash' => null,
                    'activation_expires_at' => null,
                    'activated_at' => now(),
                ]);

                $profil->user_id = $user->id;
                $profil->save();
            });
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'identifier' => 'Register gagal diproses. Periksa kembali data atau hubungi Admin.',
                ]);
        }

        return redirect()
            ->route('login')
            ->with('success', 'Register berhasil. Silakan login menggunakan identitas dan password yang sudah dibuat.');
    }

    public function showForceChangePassword()
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, ['guru', 'siswa'], true)) {
            abort(403);
        }

        if (!$user->must_change_password) {
            return $this->redirectToDashboard($user->role);
        }

        return view('auth.force-change-password');
    }

    public function forceChangePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, ['guru', 'siswa'], true)) {
            abort(403);
        }

        $request->validate([
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ],
        ]);

        $user->password = $request->input('password');
        $user->must_change_password = false;
        $user->save();

        return $this->redirectToDashboard($user->role)
            ->with('success', 'Password berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ],
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini salah.',
            ]);
        }

        $user->password = $request->input('password');
        $user->must_change_password = false;
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    private function redirectToDashboard(string $role)
    {
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => redirect()->route('login'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Kamu berhasil logout.');
    }
}