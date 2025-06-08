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
        Schema::create('welcomes', function (Blueprint $table) {
            $table->id();
            //carousel
            $table->string('title1');
            $table->text('description1');
            $table->string('image1')->nullable();

            $table->string('title2');
            $table->text('description2');
            $table->string('image2')->nullable();
            $table->timestamps();

            $table->string('title3');
            $table->text('description3');
            $table->string('image3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcomes');
    }
};
