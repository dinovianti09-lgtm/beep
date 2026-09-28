<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->integer('id_nilai')->autoIncrement();
            $table->integer('id_siswa');
            $table->integer('id_mapel');
            $table->integer('id_rapor');
            $table->decimal('nilai_harian', 5, 2)->default(0.00);
            $table->decimal('nilai_uts', 5, 2)->default(0.00);
            $table->decimal('nilai_uas', 5, 2)->default(0.00);
            $table->decimal('nilai_akhir', 5, 2)->default(0.00);
            $table->string('predikat', 5)->nullable();
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapel')->onDelete('cascade');
            $table->foreign('id_rapor')->references('id_rapor')->on('rapor')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};