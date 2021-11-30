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
        Schema::create('github_webhook_telegram_receiver', function (Blueprint $table) {
            $table->id();
            $table->foreignId('github_webhook_id')->constrained('github_webhooks')->onDelete('cascade');
            $table->foreignId('telegram_receiver_id')->constrained('telegram_receivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('github_webhook_telegram_receiver');
    }
};
