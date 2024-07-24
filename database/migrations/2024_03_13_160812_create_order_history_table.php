<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_histories', function (Blueprint $table) {
            $table->increments('order_id');
            $table->dateTime('inserted');
            $table->string('plan_type_name', 64);
            $table->integer('time_period');
            $table->string('time_string', 5);
            $table->float('fee', 10, 2);
            $table->integer('cv');
            $table->enum('featured_job', ['No', 'Yes']); 
            $table->float('total_price', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_histories');
    }
}
