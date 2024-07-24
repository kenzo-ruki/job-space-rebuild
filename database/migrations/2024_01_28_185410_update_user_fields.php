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
            $table->string('last_name')->after('name')->nullable();
            $table->renameColumn('name', 'first_name');
            $table->string('city')->after('email')->nullable();
            $table->string('country')->after('city')->nullable();
            $table->string('phone_number')->after('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['city', 'country', 'phone_number']);
        });
    }
};
