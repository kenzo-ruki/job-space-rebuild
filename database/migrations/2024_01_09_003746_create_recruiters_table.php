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
        Schema::create('recruiters', function (Blueprint $table) {
            $table->integer('recruiter_id')->primary();
            $table->string('recruiter_first_name', 32)->default('');
            $table->string('recruiter_last_name', 32)->default('');
            $table->string('recruiter_position', 128)->nullable();
            $table->string('recruiter_company_name', 128)->default('');
            $table->string('recruiter_company_seo_name', 128)->nullable();
            $table->string('recruiter_address1', 128)->default('');
            $table->string('recruiter_address2', 128)->nullable();
            $table->string('recruiter_city', 32)->default('');
            $table->integer('recruiter_country_id')->default(0);
            $table->integer('recruiter_state_id')->default(0);
            $table->string('recruiter_zip', 20)->nullable();
            $table->string('recruiter_telephone', 20)->nullable();
            $table->string('recruiter_logo', 255)->nullable();
            $table->string('recruiter_url', 255)->default('');
            $table->enum('recruiter_featured', ['Yes', 'No'])->default('No');
            $table->enum('recruiter_applywithoutlogin', ['Yes', 'No'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiters');
    }
};
