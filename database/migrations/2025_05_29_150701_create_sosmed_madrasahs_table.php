<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sosmed_madrasah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facebook_madrasah')->nullable();
            $table->string('insta_madrasah')->nullable();
            $table->string('youtube_madrasah')->nullable();
            $table->string('twitter_madrasah')->nullable();
            $table->string('tiktok_madrasah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosmed_madrasah');
    }
};
