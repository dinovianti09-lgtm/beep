<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_kelas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_kelas');

            $table->timestamps();

            $table->foreign('id_guru')
                ->references('id_guru')
                ->on('guru')
                ->onDelete('cascade');

            $table->foreign('id_kelas')
                ->references('id')
                ->on('kelas')
                ->onDelete('cascade');

            $table->unique(['id_guru', 'id_kelas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_kelas');
    }
};