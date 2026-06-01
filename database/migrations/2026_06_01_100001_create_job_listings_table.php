<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug', 5)->unique();
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->text('description');
            $table->text('requirements');
            $table->string('location');
            $table->boolean('is_remote')->default(false);
            $table->string('job_type');
            $table->json('tech_stack')->nullable();
            $table->unsignedBigInteger('salary_min')->nullable();
            $table->unsignedBigInteger('salary_max')->nullable();
            $table->string('salary_currency', 10)->default('IDR');
            $table->string('apply_url')->nullable();
            $table->string('apply_email')->nullable();
            $table->string('status')->default('pending');
            $table->text('rejection_note')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
