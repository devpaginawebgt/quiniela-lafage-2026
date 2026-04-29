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
        Schema::create('partido_brand_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partido_id')
                ->constrained('partidos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('country_id')
                ->constrained('countries')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('line_id')
                ->constrained('lines')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('brand_id')
                ->constrained('brands')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->unique(['partido_id', 'country_id', 'line_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partido_brand_assignments');
    }
};
