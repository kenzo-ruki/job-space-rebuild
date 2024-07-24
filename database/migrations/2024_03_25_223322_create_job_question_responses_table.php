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
        Schema::create('job_question_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobseeker_id')->nullable(false);
            $table->unsignedBigInteger('application_id')->nullable(false);
            $table->text('question');
            $table->text('response');
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->foreign('jobseeker_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_question_responses');
    }
};
