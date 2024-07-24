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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('plan_type_name');
            $table->integer('time_period_months');
            $table->decimal('fee', 8, 2);
            $table->integer('number_of_postable_jobs');
            $table->boolean('jobs_show_as_featured');
            $table->integer('search_cvs');
            $table->integer('priority');
            $table->text('plan_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
