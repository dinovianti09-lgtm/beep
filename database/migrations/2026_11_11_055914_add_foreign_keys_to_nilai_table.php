
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('id_siswa', 'nilai_siswa_fk')
                ->references('id_siswa')
                ->on('siswa')
                ->cascadeOnDelete();

            $table->foreign('id_mapel', 'nilai_mapel_fk')
                ->references('id_mapel')
                ->on('mapel')
                ->cascadeOnDelete();

            $table->foreign('id_rapor', 'nilai_rapor_fk')
                ->references('id_rapor')
                ->on('rapor')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign('nilai_siswa_fk');
            $table->dropForeign('nilai_mapel_fk');
            $table->dropForeign('nilai_rapor_fk');
        });
    }
};
