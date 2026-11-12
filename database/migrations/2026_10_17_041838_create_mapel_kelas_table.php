
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mapel_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mapel')->index();
            $table->string('jurusan', 50);
            $table->enum('tingkat', ['X', 'XI', 'XII']);

            $table->timestamps();

            $table->unique(
                ['id_mapel', 'jurusan', 'tingkat'],
                'mapel_kelas_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mapel_kelas');
    }
};
