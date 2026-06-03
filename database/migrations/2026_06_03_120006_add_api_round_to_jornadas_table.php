<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jornadas', function (Blueprint $table) {
            $table->string('api_round')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('jornadas', function (Blueprint $table) {
            $table->dropColumn('api_round');
        });
    }
};
