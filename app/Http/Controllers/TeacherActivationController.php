<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TeacherActivationController extends Controller
{
    public function showForm(Request $request)
    {
        return view('auth.guru-activation', [
            'token' => $request->query('token', ''),
        ]);
    }

    public function activate(Request $request)
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
        ], [
            'token.required' => 'Kode aktivasi wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        $tokenHash = hash('sha256', trim($validated['token']));

        $user = User::where('role', 'guru')
            ->where('activation_token_hash', $tokenHash)
            ->whereNotNull('activation_expires_at')
            ->where('activation_expires_at', '>', now())
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'token' => 'Kode aktivasi tidak valid, sudah digunakan, atau sudah kedaluwarsa. Hubungi Admin untuk meminta kode baru.',
            ]);
        }

        DB::transaction(function () use ($user, $validated) {
            $user->password = $validated['password'];
            $user->activated_at = now();
            $user->activation_token_hash = null;
            $user->activation_expires_at = null;
            $user->save();
        });

        return redirect()
            ->route('login')
            ->with('success', 'Aktivasi akun Guru berhasil. Silakan login menggunakan username NIP dan password baru.');
    }
}
