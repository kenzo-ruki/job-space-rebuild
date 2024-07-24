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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('job_type_id')->nullable();
            $table->string('job_category')->nullable();
            $table->string('title');
            $table->text('objective')->nullable();
            $table->boolean('relocate')->nullable();
            $table->string('resume')->nullable();
            $table->string('photo')->nullable();
            $table->text('resume_text')->nullable();
            $table->boolean('searchable')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume');
    }
};
