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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('github_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('homepage')->nullable();
            $table->string('language')->nullable();
            $table->string('novapackages_url')->nullable();
            $table->unsignedInteger('stars')->default(0);
            $table->unsignedInteger('forks')->default(0);
            $table->unsignedInteger('open_issues')->default(0);
            $table->unsignedInteger('watchers')->default(0);
            $table->unsignedInteger('rating')->nullable();
            $table->unsignedInteger('rating_count')->nullable();
            $table->unsignedInteger('packagist_downloads')->nullable();
            $table->json('topics')->nullable();
            $table->boolean('fork')->default(false);
            $table->boolean('archived')->default(false);
            $table->boolean('active')->default(false);
            $table->timestamp('github_created_at')->nullable();
            $table->timestamp('github_updated_at')->nullable();
            $table->timestamp('github_pushed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
