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
        Schema::create('job_sub_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_category_id')->constrained('job_category', 'id');
            $table->string('slug')->unique()->nullable();
            $table->string('sub_category_name', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_sub_category');
    }
};
