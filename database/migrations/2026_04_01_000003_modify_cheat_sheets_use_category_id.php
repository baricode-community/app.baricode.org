<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cheat_sheets', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->foreignId('cheat_sheet_category_id')
                ->nullable()
                ->constrained('cheat_sheet_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('cheat_sheets', function (Blueprint $table) {
            $table->dropForeign(['cheat_sheet_category_id']);
            $table->dropColumn('cheat_sheet_category_id');
            $table->string('category')->default('General');
        });
    }
};
