
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guru_kelas', function (Blueprint $table) {
            $table->foreign('id_guru', 'guru_kelas_guru_fk')
                ->references('id_guru')
                ->on('guru')
                ->cascadeOnDelete();

            $table->foreign('id_kelas', 'guru_kelas_kelas_fk')
                ->references('id')
                ->on('kelas')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('guru_kelas', function (Blueprint $table) {
            $table->dropForeign('guru_kelas_guru_fk');
            $table->dropForeign('guru_kelas_kelas_fk');
        });
    }
};
