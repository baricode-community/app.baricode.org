<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_categories', function (Blueprint $table) {
            $table->foreignId('quiz_id')->nullable()->constrained('quizzes')->nullOnDelete()->after('is_published');
            $table->unsignedTinyInteger('passing_score')->nullable()->after('quiz_id');
        });
    }

    public function down(): void
    {
        Schema::table('course_categories', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropColumn(['quiz_id', 'passing_score']);
        });
    }
};
