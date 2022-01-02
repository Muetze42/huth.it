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
    public function up()
    {
        Schema::create('client_repository', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients', 'id')->onDelete('cascade');
            $table->foreignId('repository_id')->constrained('repositories', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_repository');
    }
};
