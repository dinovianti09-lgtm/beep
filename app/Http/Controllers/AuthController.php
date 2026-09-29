<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Login
=======

class AuthController extends Controller
{
>>>>>>> c996a8b616713d7a61d128ef658671fecacfdb4c
    public function showLoginForm()
    {
        return view('auth.login');
    }

<<<<<<< HEAD
    // 2. Memproses Login
=======
>>>>>>> c996a8b616713d7a61d128ef658671fecacfdb4c
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

<<<<<<< HEAD
    // 3. Menampilkan Halaman Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 4. Memproses Registrasi Akun Baru
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:4',
            'role'     => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // 5. Memproses Logout
=======
>>>>>>> c996a8b616713d7a61d128ef658671fecacfdb4c
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}