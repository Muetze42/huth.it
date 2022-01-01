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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(false);
            $table->string('name');
            $table->string('target');
            $table->string('icon')->nullable();
            $table->unsignedInteger('count')->default(0);
            $table->unsignedInteger('real_count')->default(0);
            $table->string('color', 15);
            $table->unsignedInteger('order')->default(99999);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
};
