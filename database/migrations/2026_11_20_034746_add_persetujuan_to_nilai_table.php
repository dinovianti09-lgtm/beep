
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->string('status_persetujuan', 20)
                ->default('pending');

            $table->unsignedBigInteger('disetujui_oleh')
                ->nullable();

            $table->timestamp('disetujui_pada')
                ->nullable();

            $table->index('status_persetujuan');
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropIndex(['status_persetujuan']);

            $table->dropColumn([
                'status_persetujuan',
                'disetujui_oleh',
                'disetujui_pada',
            ]);
        });
    }
};
