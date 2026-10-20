<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
    Schema::create('rapor_siswa', function (Blueprint $table) {
        $table->id('id_rapor_siswa');
        $table->date('tgl_cetak');
        $table->string('file_pdf')->nullable();
        $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
        $table->foreignId('id_rapor')->constrained('rapor', 'id_rapor')->onDelete('cascade');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('rapor_siswa');
    }
};