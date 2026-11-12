
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bobot_nilai', function (Blueprint $table) {
            $table->foreign('id_mapel', 'bobot_nilai_mapel_fk')
                ->references('id_mapel')
                ->on('mapel')
                ->cascadeOnDelete();

            $table->foreign('id_rapor', 'bobot_nilai_rapor_fk')
                ->references('id_rapor')
                ->on('rapor')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('bobot_nilai', function (Blueprint $table) {
            $table->dropForeign('bobot_nilai_mapel_fk');
            $table->dropForeign('bobot_nilai_rapor_fk');
        });
    }
};
