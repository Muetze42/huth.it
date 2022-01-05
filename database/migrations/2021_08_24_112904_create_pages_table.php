<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Page;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('route')->nullable()->unique();
            $table->string('title');
            $table->string('description');
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->boolean('robots')->default(0);
            $table->string('controller_url')->nullable();
            $table->string('component_url')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
