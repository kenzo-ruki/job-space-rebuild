<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('orders_id');
            $table->integer('recruiter_id');
            $table->integer('product_id');
            $table->string('recruiter_name', 128);
            $table->string('recruiter_email_address', 128);
            $table->string('recruiter_company', 64)->nullable();
            $table->string('recruiter_street_address', 255);
            $table->string('recruiter_zip', 10);
            $table->string('recruiter_city', 64);
            $table->string('recruiter_state', 32)->nullable();
            $table->string('recruiter_country', 64);
            $table->string('recruiter_telephone', 20);
            $table->string('billing_name', 64);
            $table->string('billing_company', 32)->nullable();
            $table->string('billing_street_address', 255);
            $table->string('billing_city', 64);
            $table->string('billing_state', 32)->nullable();
            $table->string('billing_country', 64);
            $table->string('billing_zip', 20);
            $table->string('billing_telephone', 20);
            $table->string('payment_method', 32);
            $table->dateTime('last_modified')->nullable();
            $table->dateTime('date_purchased')->nullable();
            $table->integer('orders_status');
            $table->dateTime('orders_date_finished')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
