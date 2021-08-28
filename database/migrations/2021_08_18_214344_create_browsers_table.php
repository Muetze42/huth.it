<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Browser;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('browsers', function (Blueprint $table) {
            $table->id();
            $table->boolean('device_type')->default(Browser::DEVICE_TYPE_UNKNOWN);
            $table->boolean('is_bot');
            $table->boolean('os');
            $table->string('browser_name');
            $table->string('browser_family');
            $table->string('browser_version');
            $table->integer('browser_version_major');
            $table->integer('browser_version_minor');
            $table->integer('browser_version_patch');
            $table->string('browser_engine');
            $table->string('platform_name');
            $table->string('platform_family');
            $table->string('platform_version');
            $table->integer('plattform_version_major');
            $table->integer('plattform_version_minor');
            $table->bigInteger('plattform_version_patch');
            $table->string('device_family')->nullable();
            $table->string('device_model')->nullable();
            $table->string('mobile_grade')->nullable();
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
        Schema::dropIfExists('browsers');
    }
};
