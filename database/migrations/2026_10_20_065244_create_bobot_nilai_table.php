<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bobot_nilai', function (Blueprint $table) {
            $table->id('id_bobot');

            $table->foreignId('id_mapel')
                ->constrained('mapel', 'id_mapel')
                ->cascadeOnDelete();

            $table->foreignId('id_rapor')
                ->constrained('rapor', 'id_rapor')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('bobot_harian')->default(30);
            $table->unsignedTinyInteger('bobot_uts')->default(30);
            $table->unsignedTinyInteger('bobot_uas')->default(40);

            $table->timestamps();

            $table->unique(
                ['id_mapel', 'id_rapor'],
                'bobot_nilai_mapel_rapor_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bobot_nilai');
    }
};
