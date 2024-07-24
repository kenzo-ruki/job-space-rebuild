<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->nullable(false);
            $table->unsignedBigInteger('recruiter_id')->nullable(false);
            $table->text('question');
            $table->timestamps();

            $table->foreign('job_id')->references('job_id')->on('jobs')->onDelete('cascade');
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
        Schema::dropIfExists('job_questions');
    }

};
