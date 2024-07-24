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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->string('image');
            $table->string('header');
            $table->string('text');
            $table->string('link');
            $table->timestamps();    

            $table->foreign('slider_id')->references('id')->on('sliders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
