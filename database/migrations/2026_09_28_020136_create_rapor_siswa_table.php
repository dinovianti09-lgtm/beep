
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapor_siswa', function (Blueprint $table) {
            $table->id('id_rapor_siswa');
            $table->dateTime('tgl_cetak')->nullable();
            $table->string('file_pdf')->nullable();

            $table->unsignedBigInteger('id_siswa')->index();
            $table->unsignedBigInteger('id_rapor')->index();

            $table->timestamps();

            $table->unique(['id_siswa', 'id_rapor']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapor_siswa');
    }
};
