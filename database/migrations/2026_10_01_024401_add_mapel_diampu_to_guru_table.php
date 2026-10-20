<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->string('mapel_diampu', 100)->nullable()->after('nama_guru');
        });
    }

    public function down()
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->dropColumn('mapel_diampu');
        });
    }
};