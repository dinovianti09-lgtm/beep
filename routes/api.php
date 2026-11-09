
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\SiswaApiController;
use App\Http\Controllers\Api\GuruApiController;
use App\Http\Controllers\Api\MapelApiController;
use App\Http\Controllers\Api\NilaiApiController;
use App\Http\Middleware\EnsureApiAccountIsActive;

// Login API tanpa token.
Route::post('/login', [AuthApiController::class, 'login'])
    ->middleware('throttle:api-login');

// Semua route berikut memerlukan token Sanctum
// dan pemeriksaan status akun terbaru.
Route::middleware([
    'auth:sanctum',
    EnsureApiAccountIsActive::class,
])->group(function () {

    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()->only([
                'id',
                'username',
                'role',
                'status',
            ]),
        ]);
    });

    Route::post('/logout', [AuthApiController::class, 'logout']);

    // Data siswa.
    Route::get('/siswa', [SiswaApiController::class, 'index']);
    Route::get('/siswa/{id}', [SiswaApiController::class, 'show']);

    // Data guru.
    Route::get('/guru', [GuruApiController::class, 'index']);
    Route::get('/guru/{id}', [GuruApiController::class, 'show']);

    // Data mata pelajaran.
    Route::get('/mapel', [MapelApiController::class, 'index']);
    Route::get('/mapel/{id}', [MapelApiController::class, 'show']);

    // Data nilai.
    Route::get('/nilai', [NilaiApiController::class, 'index']);
    Route::get('/nilai/{id}', [NilaiApiController::class, 'show']);
});
