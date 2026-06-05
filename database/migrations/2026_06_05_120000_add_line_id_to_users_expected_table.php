<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users_expected', function (Blueprint $table) {
            $table->index('user_type_id', 'users_expected_user_type_id_index');
            $table->dropUnique(['user_type_id', 'country_id']);

            $table->foreignId('line_id')
                ->nullable()
                ->after('country_id')
                ->constrained('lines')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->unique(['user_type_id', 'country_id', 'line_id']);
        });
    }

    public function down(): void
    {
        Schema::table('users_expected', function (Blueprint $table) {
            $table->dropUnique(['user_type_id', 'country_id', 'line_id']);
            $table->dropConstrainedForeignId('line_id');
            $table->unique(['user_type_id', 'country_id']);
            $table->dropIndex('users_expected_user_type_id_index');
        });
    }
};
