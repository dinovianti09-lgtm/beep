
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\RaporSiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SiswaNilaiController;
use App\Http\Controllers\GuruSiswaController;
use App\Http\Controllers\GuruRaporController;
use App\Http\Controllers\GuruRaporTambahanController;
use App\Http\Controllers\BobotNilaiController;


// ========================================
// ROUTES UMUM
// ========================================

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');


// ========================================
// GANTI PASSWORD WAJIB GURU DAN SISWA
// ========================================

Route::middleware(['auth', 'role:guru,siswa'])->group(function () {
    Route::get('/ganti-password-wajib', [
        AuthController::class,
        'showForceChangePassword',
    ])->name('password.force-change');

    Route::post('/ganti-password-wajib', [
        AuthController::class,
        'forceChangePassword',
    ])->name('password.force-change.process');
});


// ========================================
// LOGOUT
// ========================================

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ========================================
// ROUTES ADMIN
// ========================================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD

        Route::get('/dashboard', [
            DashboardController::class,
            'index',
        ])->name('dashboard');


        // PROFIL

        Route::get('/profil', function () {
            return view('admin.profil');
        })->name('profil');

        Route::post('/profil/password', [
            AuthController::class,
            'updatePassword',
        ])->name('profil.password');


        // DATA SISWA

        Route::get('/siswa/template', [
            SiswaController::class,
            'downloadTemplate',
        ])->name('siswa.template');

        Route::post('/siswa/import', [
            SiswaController::class,
            'import',
        ])->name('siswa.import');

        Route::get('/siswa/export', [
            SiswaController::class,
            'export',
        ])->name('siswa.export');

        Route::post('/siswa/{id}/reset-password', [
            SiswaController::class,
            'resetPassword',
        ])->name('siswa.resetPassword');

        Route::patch('/siswa/{siswa}/status', [
            SiswaController::class,
            'toggleStatus',
        ])->name('siswa.toggleStatus');

        Route::resource('siswa', SiswaController::class);


        // DATA GURU

        Route::get('/guru/template', [
            GuruController::class,
            'downloadTemplate',
        ])->name('guru.template');

        Route::post('/guru/import', [
            GuruController::class,
            'import',
        ])->name('guru.import');

        Route::get('/guru/export', [
            GuruController::class,
            'export',
        ])->name('guru.export');

        Route::post('/guru/{id}/reset-password', [
            GuruController::class,
            'resetPassword',
        ])->name('guru.resetPassword');

        Route::patch('/guru/{guru}/status', [
            GuruController::class,
            'toggleStatus',
        ])->name('guru.toggleStatus');

        Route::resource('guru', GuruController::class);


        // DATA MAPEL DAN KELAS

        Route::resource('mapel', MapelController::class);

        Route::resource('kelas', KelasController::class);


        // DATA NILAI ADMIN
        // ADMIN HANYA MELIHAT DATA NILAI

        Route::get('/nilai', [
            NilaiController::class,
            'index',
        ])->name('nilai.index');


        // DATA RAPOR ADMIN

        Route::resource('rapor', RaporController::class)
            ->except(['show']);

        Route::get('/rapor/{id}/lihat', [
            RaporController::class,
            'showRapor',
        ])->name('rapor.lihat');

        Route::resource('rapor_siswa', RaporSiswaController::class)
            ->except(['edit', 'update']);
    });


// ========================================
// ROUTES GURU
// ========================================

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        // DASHBOARD

        Route::get('/dashboard', [
            DashboardController::class,
            'guru',
        ])->name('dashboard');


        // PROFIL

        Route::get('/profil', function () {
            return view('guru.profil');
        })->name('profil');

        Route::post('/profil/password', [
            AuthController::class,
            'updatePassword',
        ])->name('profil.password');


        // DATA SISWA GURU

        Route::get('/siswa', [
            GuruSiswaController::class,
            'index',
        ])->name('siswa.index');


        // INPUT NILAI MANUAL

        Route::get('/nilai/input', [
            NilaiController::class,
            'create',
        ])->name('nilai.create');

        Route::post('/nilai/input', [
            NilaiController::class,
            'store',
        ])->name('nilai.store');


        // TEMPLATE, IMPORT, EXPORT NILAI GURU

        Route::get('/nilai/template', [
            NilaiController::class,
            'downloadTemplate',
        ])->name('nilai.template');

        Route::get('/nilai/export', [
            NilaiController::class,
            'export',
        ])->name('nilai.export');

        Route::post('/nilai/import', [
            NilaiController::class,
            'import',
        ])->name('nilai.import');


        // PENGATURAN BOBOT NILAI

        Route::get('/bobot-nilai', [
            BobotNilaiController::class,
            'index',
        ])->name('bobot-nilai.index');

        Route::post('/bobot-nilai', [
            BobotNilaiController::class,
            'update',
        ])->name('bobot-nilai.update');


        // REKAP NILAI GURU

        Route::get('/rekap', [
            RekapController::class,
            'index',
        ])->name('rekap.index');

        Route::get('/rekap/{id}/edit', [
            RekapController::class,
            'edit',
        ])->name('rekap.edit');

        Route::put('/rekap/{id}', [
            RekapController::class,
            'update',
        ])->name('rekap.update');

        Route::delete('/rekap/{id}', [
            RekapController::class,
            'destroy',
        ])->name('rekap.destroy');


        // ========================================
        // RAPOR KHUSUS GURU WALI KELAS
        // ========================================

        // DAFTAR RAPOR

        Route::get('/rapor', [
            GuruRaporController::class,
            'index',
        ])->name('rapor.index');


        // DETAIL RAPOR

        Route::get('/rapor/{id}', [
            GuruRaporController::class,
            'show',
        ])->name('rapor.show');


        // ========================================
        // KEHADIRAN DAN EKSTRAKURIKULER RAPOR
        // ========================================

        Route::post('/rapor/kehadiran', [
            GuruRaporTambahanController::class,
            'simpanKehadiran',
        ])->name('rapor.kehadiran.simpan');

        Route::post('/rapor/ekstrakurikuler', [
            GuruRaporTambahanController::class,
            'simpanEkstrakurikuler',
        ])->name('rapor.ekstrakurikuler.simpan');
    });


// ========================================
// ROUTES SISWA
// ========================================

Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        // DASHBOARD

        Route::get('/dashboard', [
            DashboardController::class,
            'siswa',
        ])->name('dashboard');


        // NILAI

        Route::get('/nilai', [
            SiswaNilaiController::class,
            'index',
        ])->name('nilai.index');


        // TRANSKRIP / RAPOR SISWA

        Route::get('/transkrip', [
            SiswaNilaiController::class,
            'transkrip',
        ])->name('rapor.index');


        // PROFIL

        Route::get('/profil', function () {
            return view('siswa.profil');
        })->name('profil');

        Route::post('/profil/password', [
            AuthController::class,
            'updatePassword',
        ])->name('profil.password');
    });
