<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('github_id')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('homepage')->nullable();
            $table->string('language')->nullable();
            $table->string('novapackages_url')->nullable();
            $table->unsignedInteger('stars');
            $table->unsignedInteger('forks');
            $table->unsignedInteger('open_issues');
            $table->unsignedInteger('watchers');
            $table->unsignedInteger('rating')->nullable();
            $table->unsignedInteger('rating_count')->nullable();
            $table->unsignedInteger('packagist_downloads')->nullable();
            $table->boolean('fork');
            $table->boolean('archived');
            $table->json('topics')->nullable();
            $table->timestamp('github_created_at')->nullable();
            $table->timestamp('github_updated_at')->nullable();
            $table->timestamp('github_pushed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};