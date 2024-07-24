<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->integer('job_id')->primary();
            $table->string('slug')->unique()->nullable();
            $table->string('display_id', 32)->default('');
            $table->integer('recruiter_id')->default(0);
            $table->enum('job_source', ['jobsite','indeed','simplyhired','ziprecruiter','usajobs','csv','jobadder'])->default('jobsite');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->date('unpublished')->nullable();
            $table->timestamp('re_adv')->nullable();
            $table->timestamp('expired')->nullable();
            $table->string('job_title', 255)->default('');
            $table->string('job_reference', 64)->default('');
            $table->string('job_country_id', 5)->default('');
            $table->string('job_state_id', 5)->nullable();
            $table->string('job_city_id', 512)->nullable();
            $table->string('job_state', 64)->nullable();
            $table->string('job_location', 64)->default('');
            $table->string('salary_from', 255)->nullable();
            $table->string('salary_to', 255)->nullable();
            $table->longText('salary_description')->nullable();
            $table->text('job_short_description');
            $table->text('job_description');
            $table->string('job_type', 5)->nullable();
            $table->string('job_vacancy_period', 15)->default('');
            $table->enum('job_status', ['Yes', 'No'])->default('Yes');
            $table->enum('job_featured', ['Yes', 'No'])->default('No');
            $table->string('job_email_to', 64)->nullable();
            $table->string('url', 255)->default('');
            $table->integer('job_auto_renew')->default(0);
            $table->longText('video_link')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
