<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class WebAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware(['web', 'auth', 'role:admin'])
            ->get('/_test/admin-only', fn () => response('OK'));

        Route::middleware(['web', 'auth', 'role:guru'])
            ->get('/_test/guru-only', fn () => response('OK'));

        Route::middleware(['web', 'auth', 'role:siswa'])
            ->get('/_test/siswa-only', fn () => response('OK'));
    }

    private function buatUser(string $role, string $status = 'aktif'): User
    {
        return User::factory()->create([
            'role' => $role,
            'status' => $status,
        ]);
    }

    public function test_pengunjung_tanpa_login_ditolak(): void
    {
        $this->get('/_test/admin-only')
            ->assertRedirect(route('login'));
    }

    public function test_admin_hanya_bisa_masuk_halaman_admin(): void
    {
        $admin = $this->buatUser('admin');

        $this->actingAs($admin)
            ->get('/_test/admin-only')
            ->assertOk();

        $this->get('/_test/guru-only')->assertForbidden();
        $this->get('/_test/siswa-only')->assertForbidden();
    }

    public function test_guru_hanya_bisa_masuk_halaman_guru(): void
    {
        $guru = $this->buatUser('guru');

        $this->actingAs($guru)
            ->get('/_test/guru-only')
            ->assertOk();

        $this->get('/_test/admin-only')->assertForbidden();
        $this->get('/_test/siswa-only')->assertForbidden();
    }

    public function test_siswa_hanya_bisa_masuk_halaman_siswa(): void
    {
        $siswa = $this->buatUser('siswa');

        $this->actingAs($siswa)
            ->get('/_test/siswa-only')
            ->assertOk();

        $this->get('/_test/admin-only')->assertForbidden();
        $this->get('/_test/guru-only')->assertForbidden();
    }

    public function test_guru_nonaktif_dikeluarkan(): void
    {
        $guru = $this->buatUser('guru', 'nonaktif');

        $this->actingAs($guru)
            ->get('/_test/guru-only')
            ->assertRedirect(route('login'));
    }

    public function test_siswa_nonaktif_dikeluarkan(): void
    {
        $siswa = $this->buatUser('siswa', 'nonaktif');

        $this->actingAs($siswa)
            ->get('/_test/siswa-only')
            ->assertRedirect(route('login'));
    }
}
