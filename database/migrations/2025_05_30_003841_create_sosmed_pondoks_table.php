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
        Schema::create('sosmed_pondok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facebook_pondok')->nullable();
            $table->string('insta_pondok')->nullable();
            $table->string('youtube_pondok')->nullable();
            $table->string('twitter_pondok')->nullable();
            $table->string('tiktok_pondok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosmed_pondok');
    }
};
