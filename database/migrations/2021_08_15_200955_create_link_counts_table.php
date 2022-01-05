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
        Schema::create('link_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->text('os');
            $table->text('client');
            $table->string('ip')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_counts');
    }
};
