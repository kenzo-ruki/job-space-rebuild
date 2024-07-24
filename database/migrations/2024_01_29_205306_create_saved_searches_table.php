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
        Schema::create('saved_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('keywords')->nullable();
            $table->string('location')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('job_type')->nullable();
            $table->string('salary')->nullable();
            $table->string('company')->nullable();
            $table->string('date_window')->nullable();
            $table->string('frequency')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_searches');
    }
};
