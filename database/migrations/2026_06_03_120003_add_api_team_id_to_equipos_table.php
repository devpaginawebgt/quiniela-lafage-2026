<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->unsignedBigInteger('api_team_id')->nullable()->after('grupo');

            $table->foreign('api_team_id')
                ->references('api_team_id')
                ->on('api_teams')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->dropForeign(['api_team_id']);
            $table->dropColumn('api_team_id');
        });
    }
};
