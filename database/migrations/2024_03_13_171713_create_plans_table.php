<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('plans_name', 64)->index();
            $table->text('plan_desc')->nullable();
            $table->integer('priority')->default(0);
            $table->smallInteger('time_period')->default(0);
            $table->string('time_string', 5);
            $table->float('fee', 10, 2)->default(0.00);
            $table->integer('cv')->default(0);
            $table->enum('featured_job', ['No', 'Yes'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
