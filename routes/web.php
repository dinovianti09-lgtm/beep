<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RaporController;

// Rute Halaman Login
Route::get('/', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Input Nilai (Khusus Guru)
Route::post('/nilai/simpan', [NilaiController::class, 'storeOrUpdate'])->name('nilai.simpan');

// Rute Cetak Rapor PDF (Khusus Siswa/Guru)
Route::get('/rapor/cetak/{id_siswa}/{id_rapor}', [RaporController::class, 'cetakPdf'])->name('rapor.cetak');