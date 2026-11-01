<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use PDOException;
use Tests\TestCase;

class ErrorHandlingTest extends TestCase
{
    public function test_debug_is_disabled_during_testing(): void
    {
        $this->assertFalse(
            (bool) config('app.debug'),
            'APP_DEBUG harus false saat pengujian.'
        );
    }

    public function test_unknown_page_shows_custom_404_page(): void
    {
        $response = $this->get('/halaman-tidak-ada-xyz');

        $response->assertStatus(404);
        $response->assertViewIs('errors.404');
    }

    public function test_server_error_shows_custom_500_page(): void
    {
        Route::get('/_test-error-500', function () {
            throw new \RuntimeException('Tes error 500 EDUVIA');
        });

        $response = $this->get('/_test-error-500');

        $response->assertStatus(500);
        $response->assertViewIs('errors.500');
        $response->assertSee(
            'Terjadi kendala koneksi server. Silakan hubungi admin.'
        );
        $response->assertDontSee('Tes error 500 EDUVIA');
    }

    public function test_database_connection_error_shows_friendly_500_page(): void
    {
        Route::get('/_test-error-database', function () {
            throw new PDOException(
                'Tes koneksi database gagal EDUVIA'
            );
        });

        $response = $this->get('/_test-error-database');

        $response->assertStatus(500);
        $response->assertViewIs('errors.500');
        $response->assertSee(
            'Terjadi kendala koneksi server. Silakan hubungi admin.'
        );
        $response->assertDontSee(
            'Tes koneksi database gagal EDUVIA'
        );
    }
}
