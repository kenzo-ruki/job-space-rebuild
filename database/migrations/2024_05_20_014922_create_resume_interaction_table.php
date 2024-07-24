<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumeInteractionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_interaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resume_id');
            $table->unsignedBigInteger('jobseeker_id');
            $table->unsignedBigInteger('recruiter_id');
            $table->string('subject');
            $table->text('message');
            $table->string('attachment_file')->nullable();
            $table->boolean('user_see')->default(false);
            $table->string('sender');

            $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('cascade');
            $table->foreign('jobseeker_id')->references('jobseeker_id')->on('users')->onDelete('cascade');
            $table->foreign('recruiter_id')->references('recruiter_id')->on('recruiters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_interaction');
    }
}