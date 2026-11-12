
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kehadiran_siswa', function (Blueprint $table) {
            $table->id('id_kehadiran');

            $table->unsignedBigInteger('id_siswa')->index();
            $table->unsignedBigInteger('id_rapor')->index();

            $table->unsignedInteger('sakit')->default(0);
            $table->unsignedInteger('izin')->default(0);
            $table->unsignedInteger('tanpa_keterangan')->default(0);

            $table->timestamps();

            $table->unique(['id_siswa', 'id_rapor']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kehadiran_siswa');
    }
};
