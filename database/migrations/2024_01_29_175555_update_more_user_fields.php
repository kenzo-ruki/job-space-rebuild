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
        //      
        Schema::table('users', function (Blueprint $table) {
            $table->string('cv_visible')->after('email_verified_at')->default(0); //boolean
            $table->string('contact_details_visibility')->after('email_verified_at')->default(1); //1, 2, 3
            $table->string('newsletter')->after('email_verified_at')->default(0); //boolean 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cv_visible', 'contact_details_visibility', 'newsletter']);
        });
    }
};
