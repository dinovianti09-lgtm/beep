
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kehadiran_siswa', function (Blueprint $table) {
            $table->foreign('id_siswa', 'kehadiran_siswa_siswa_fk')
                ->references('id_siswa')
                ->on('siswa')
                ->cascadeOnDelete();

            $table->foreign('id_rapor', 'kehadiran_siswa_rapor_fk')
                ->references('id_rapor')
                ->on('rapor')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kehadiran_siswa', function (Blueprint $table) {
            $table->dropForeign('kehadiran_siswa_siswa_fk');
            $table->dropForeign('kehadiran_siswa_rapor_fk');
        });
    }
};
