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
        Schema::table('countries', function (Blueprint $table) {
            $table->integer('expected_users')->nullable()->after('timezone');
            $table->integer('expected_clerks')->nullable()->after('expected_users');
            $table->integer('expected_doctors')->nullable()->after('expected_clerks');
            $table->integer('expected_collaborators')->nullable()->after('expected_doctors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn(['expected_users', 'expected_clerks', 'expected_doctors', 'expected_collaborators']);
        });
    }
};
