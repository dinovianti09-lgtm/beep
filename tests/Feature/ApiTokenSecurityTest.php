<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ApiTokenSecurityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Database sementara SQLite in-memory.
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => false,
        ]);

        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('status')->nullable();
            $table->boolean('must_change_password')->default(false);
            $table->string('activation_token_hash', 64)->nullable();
            $table->timestamp('activation_expires_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->text('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
        });
    }

    private function buatUser(
        string $role,
        ?string $status = 'aktif',
        bool $wajibGantiPassword = false
    ): User {
        return User::create([
            'username' => $role . '-test',
            'password' => Hash::make('password123'),
            'role' => $role,
            'status' => $status,
            'must_change_password' => $wajibGantiPassword,
        ]);
    }

    public function test_admin_dapat_login_dan_mengakses_api(): void
    {
        $this->buatUser('admin');

        $login = $this->postJson('/api/login', [
            'role' => 'admin',
            'identity' => 'admin-test',
            'password' => 'password123',
        ]);

        $login->assertOk()
            ->assertJsonPath('success', true);

        $token = $login->json('token');

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('data.role', 'admin');
    }

    public function test_guru_aktif_dapat_mengakses_api(): void
    {
        $user = $this->buatUser('guru');

        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('data.role', 'guru');
    }

    public function test_siswa_aktif_dapat_mengakses_api(): void
    {
        $user = $this->buatUser('siswa');

        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('data.role', 'siswa');
    }

    public function test_guru_nonaktif_ditolak_dan_token_dicabut(): void
    {
        $user = $this->buatUser('guru', 'nonaktif');

        $token = $user->createToken('test')->plainTextToken;
        $tokenId = explode('|', $token, 2)[0];

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertForbidden();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $tokenId,
        ]);
    }

    public function test_siswa_nonaktif_ditolak(): void
    {
        $user = $this->buatUser('siswa', 'nonaktif');

        $token = $user->createToken('test')->plainTextToken;
        $tokenId = explode('|', $token, 2)[0];

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertForbidden();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $tokenId,
        ]);
    }

    public function test_status_kosong_ditolak(): void
    {
        $user = $this->buatUser('siswa', null);

        $token = $user->createToken('test')->plainTextToken;
        $tokenId = explode('|', $token, 2)[0];

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertForbidden();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $tokenId,
        ]);
    }

    public function test_wajib_ganti_password_ditolak_dari_api(): void
    {
        $user = $this->buatUser('guru', 'aktif', true);

        $token = $user->createToken('test')->plainTextToken;
        $tokenId = explode('|', $token, 2)[0];

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertForbidden();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $tokenId,
        ]);
    }

    public function test_logout_hanya_mencabut_token_yang_digunakan(): void
    {
        $user = $this->buatUser('admin');

        $tokenPertama = $user->createToken('perangkat-1')->plainTextToken;
        $tokenKedua = $user->createToken('perangkat-2')->plainTextToken;

        $idTokenPertama = explode('|', $tokenPertama, 2)[0];
        $idTokenKedua = explode('|', $tokenKedua, 2)[0];

        $this->withToken($tokenPertama)
            ->postJson('/api/logout')
            ->assertOk();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $idTokenPertama,
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'id' => $idTokenKedua,
        ]);

        $this->assertDatabaseCount('personal_access_tokens', 1);
    }
}
