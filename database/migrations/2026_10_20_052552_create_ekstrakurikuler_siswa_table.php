
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekstrakurikuler_siswa', function (Blueprint $table) {
            $table->id('id_ekstrakurikuler_siswa');

            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_rapor');

            $table->string('nama_ekstrakurikuler');
            $table->string('predikat')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikuler_siswa');
    }
};
