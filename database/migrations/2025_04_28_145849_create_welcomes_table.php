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
            $table->string('image1');

            $table->string('title2');
            $table->text('description2');
            $table->string('image2');
            $table->timestamps();

            $table->string('title3');
            $table->text('description3');
            $table->string('image3');

            //about
            $table->string('about_description');
            $table->string('about_image');

            //contact
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('facebook')->default('#');
            $table->string('instagram')->default('#');
            $table->string('youtube')->default('#');
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
