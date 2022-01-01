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
        Schema::create('customer_api_clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->unique();
            $table->string('description');
            $table->text('token');
            $table->text('refresh_token');
            $table->unsignedInteger('token_lifetime')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_api_clients');
    }
};
