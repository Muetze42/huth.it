<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Config;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('config_id')->nullable();
            $table->boolean('type')->default(false);
            $table->string('key');
            $table->text('content')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
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
        Schema::dropIfExists('config_items');
    }
};
