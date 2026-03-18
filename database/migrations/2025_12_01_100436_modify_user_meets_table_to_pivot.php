<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_meets', function (Blueprint $table) {
            // Hapus kolom yang tidak diperlukan untuk pivot table
            $table->dropColumn(['title', 'scheduled_at', 'status']);

            // Tambahkan kolom meet_id untuk relasi ke tabel meets
            $table->foreignId('meet_id')->constrained('meets', 'id')->onDelete('cascade');

            // Rename description untuk menjadi description khusus user
            // Description ini akan berisi catatan khusus untuk setiap user di meet tertentu
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_meets', function (Blueprint $table) {
            // Kembalikan struktur asli
            $table->dropForeign(['meet_id']);
            $table->dropColumn('meet_id');

            // Tambahkan kembali kolom yang dihapus
            $table->string('title')->nullable(false);
            $table->dateTime('scheduled_at')->nullable(true);
            $table->string('status')->nullable(false)->default('scheduled');
        });
    }
};
