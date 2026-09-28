<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapor', function (Blueprint $table) {
            $table->integer('id_rapor')->autoIncrement();
            $table->enum('semester', ['1', '2', 'Ganjil', 'Genap']);
            $table->string('tahun_ajaran', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapor');
    }
};