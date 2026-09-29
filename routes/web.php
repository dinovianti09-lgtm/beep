<?php

use Illuminate\Support\Facades\Route;

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
});