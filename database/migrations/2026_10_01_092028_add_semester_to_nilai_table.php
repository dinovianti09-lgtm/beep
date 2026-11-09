
<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom semester sudah dibuat di migration create_nilai_table.
    }

    public function down(): void
    {
        // Tidak menghapus kolom semester karena dimiliki migration utama.
    }
};
