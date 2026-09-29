<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RaporController;

<<<<<<< HEAD
// 1. Landing Page (Awal)
Route::get('/', function () {
    return view('landing');
});

// 2. Autentikasi
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

// 3. Dashboard / Beranda
Route::get('/beranda', function () {
    return view('beranda');
});

// 4. Data Master
Route::get('/siswa', function () {
    return view('siswa');
});

Route::get('/guru', function () {
    return view('guru');
});

// 5. Transaksi
Route::get('/nilai', function () {
    return view('nilai');
});

Route::get('/rapor', function () {
    return view('rapor');
=======
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/nilai/simpan', [NilaiController::class, 'store'])->name('nilai.simpan');
    Route::get('/rapor/cetak/{siswa_id}', [RaporController::class, 'cetakPdf'])->name('rapor.cetak');
>>>>>>> c996a8b616713d7a61d128ef658671fecacfdb4c
});