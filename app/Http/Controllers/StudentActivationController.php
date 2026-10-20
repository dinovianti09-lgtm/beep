<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class StudentActivationController extends Controller
{
    public function showForm(Request $request)
    {
        return view('auth.siswa-activation', [
            'token' => $request->query('token', ''),
        ]);
    }

    public function createLink($id)
    {
        $siswa = Siswa::findOrFail($id);

        if (!$siswa->user_id) {
            return back()->with('error',
                'Siswa ini belum memiliki akun login.'
            );
        }

        $user = User::where('id', $siswa->user_id)
            ->where('role', 'siswa')
            ->first();

        if (!$user) {
            return back()->with('error',
                'Akun login Siswa tidak ditemukan.'
            );
        }

        $token = Str::random(64);

        $user->activation_token_hash = hash('sha256', $token);
        $user->activation_expires_at = now()->addHours(24);
        $user->activated_at = null;
        $user->save();

        return back()->with([
            'success' => 'Tautan aktivasi berhasil dibuat untuk ' .
                $siswa->nama_siswa . '.',
            'activation_username' => $user->username,
            'activation_url' => url('/aktivasi-siswa?token=' . $token),
        ]);
    }

    public function activate(Request $request)
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ],
        ], [
            'token.required' => 'Kode aktivasi wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $tokenHash = hash('sha256', $validated['token']);

        $user = User::where('role', 'siswa')
            ->where('activation_token_hash', $tokenHash)
            ->whereNotNull('activation_expires_at')
            ->where('activation_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()
                ->withInput($request->only('token'))
                ->withErrors([
                    'token' => 'Kode aktivasi tidak valid atau sudah kedaluwarsa. Minta tautan baru kepada Admin.',
                ]);
        }

        DB::transaction(function () use ($user, $validated) {
            $user->password = $validated['password'];
            $user->activated_at = now();
            $user->activation_token_hash = null;
            $user->activation_expires_at = null;
            $user->save();
        });

        return redirect()->route('login')->with(
            'success',
            'Aktivasi akun Siswa berhasil. Silakan login menggunakan NIS dan password baru.'
        );
    }
}