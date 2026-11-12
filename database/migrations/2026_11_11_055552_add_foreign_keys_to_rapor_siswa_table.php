<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rapor_siswa', function (Blueprint $table) {
            $table->foreign('id_siswa', 'rapor_siswa_siswa_fk')
                ->references('id_siswa')
                ->on('siswa')
                ->cascadeOnDelete();

            $table->foreign('id_rapor', 'rapor_siswa_rapor_fk')
                ->references('id_rapor')
                ->on('rapor')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('rapor_siswa', function (Blueprint $table) {
            $table->dropForeign('rapor_siswa_siswa_fk');
            $table->dropForeign('rapor_siswa_rapor_fk');
        });
    }
};