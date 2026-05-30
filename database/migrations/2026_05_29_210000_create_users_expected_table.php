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
        Schema::create('users_expected', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_type_id')
                ->constrained('user_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('country_id')
                ->constrained('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('expected')->default(0);
            $table->unique(['user_type_id', 'country_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_expected');
    }
};
