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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('about')->nullable();
            $table->longText('contact')->nullable();
            $table->longText('terms')->nullable();
            $table->longText('privacy')->nullable();
            $table->longText('email')->nullable();
            $table->longText('mobile')->nullable();
            $table->longText('whatsapp')->nullable();
            $table->longText('about_en')->nullable();
            $table->longText('terms_en')->nullable();
            $table->longText('privacy_en')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
