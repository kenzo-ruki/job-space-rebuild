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
        Schema::create('job_job_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs', 'job_id')->onDelete('cascade');
            $table->foreignId('job_category_id')->constrained('job_category', 'id')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_job_category');
    }
};
