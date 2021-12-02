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
        Schema::create('github_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('event');
            $table->json('branches')->nullable();
            $table->json('actions')->nullable();
            $table->text('slug')->nullable();
            $table->text('secret')->nullable();
            $table->text('message');
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
        Schema::dropIfExists('github_webhooks');
    }
};
