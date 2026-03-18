<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repo_hub_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('repo_hubs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('repo_url');
            $table->string('demo_url')->nullable();
            $table->text('why_recommended');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

        Schema::create('repo_hub_tag', function (Blueprint $table) {
            $table->foreignId('repo_hub_id')->constrained()->cascadeOnDelete();
            $table->foreignId('repo_hub_tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['repo_hub_id', 'repo_hub_tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repo_hub_tag');
        Schema::dropIfExists('repo_hubs');
        Schema::dropIfExists('repo_hub_tags');
    }
};
