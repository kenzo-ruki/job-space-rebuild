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
        Schema::create('applications', function (Blueprint $table) {
            $table->id('id');
            $table->string('application_id');
            $table->foreignId('job_id')->constrained('jobs', 'job_id');
            $table->foreignId('user_id')->constrained();
            $table->text('cover_letter');
            $table->foreignId('resume_id')->constrained();
            $table->boolean('applicant_select');
            $table->string('applicant_join_status');
            $table->timestamp('selected_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
