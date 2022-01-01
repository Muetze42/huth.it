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
        Schema::create('customer_api_client_repository', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_api_client_id')->constrained('customer_api_clients')->onDelete('cascade');
            $table->foreignId('repository_id')->constrained('repositories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_api_client_repository');
    }
};
