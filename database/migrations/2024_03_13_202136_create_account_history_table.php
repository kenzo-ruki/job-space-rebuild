<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recruiter_id')->index();
            $table->integer('order_id');
            $table->datetime('inserted');
            $table->datetime('updated')->nullable();
            $table->string('plan_type_name', 32);
            $table->enum('plan_for', ['job_post', 'resume_search'])->default('job_post');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('recruiter_job');
            $table->enum('recruiter_cv_status', ['Yes','No'])->default('No');
            $table->integer('recruiter_cv');
            $table->integer('job_enjoyed');
            $table->integer('cv_enjoyed');
            $table->enum('featured_job', ['No','Yes'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_history');
    }
}
