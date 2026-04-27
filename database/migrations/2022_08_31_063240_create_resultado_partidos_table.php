<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoPartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_partidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partido_id')->unique();
            $table->integer('goles_equipo_1')->default(0);
            $table->integer('goles_equipo_2')->default(0);
            $table->unsignedBigInteger('equipo_ganador_id')->nullable();
            $table->timestamps();

            $table->foreign('partido_id')->references('id')->on('partidos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('equipo_ganador_id')->references('id')->on('equipos')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultado_partidos');
    }
}
