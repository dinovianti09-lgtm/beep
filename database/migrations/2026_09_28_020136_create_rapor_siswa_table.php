<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapor_siswa', function (Blueprint $table) {
            $table->integer('id_rapor_siswa')->autoIncrement();
            $table->date('tgl_cetak');
            $table->string('file_pdf')->nullable();
            $table->integer('id_siswa');
            $table->integer('id_rapor');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_rapor')->references('id_rapor')->on('rapor')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapor_siswa');
    }
};