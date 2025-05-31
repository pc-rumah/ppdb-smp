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
        Schema::create('sosmed_smp', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_smp')->nullable();
            $table->string('insta_smp')->nullable();
            $table->string('youtube_smp')->nullable();
            $table->string('twitter_smp')->nullable();
            $table->string('tiktok_smp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosmed_smp');
    }
};
