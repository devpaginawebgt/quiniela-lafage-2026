<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoPartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_partidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partido_id');
            $table->unsignedBigInteger('equipo_1');
            $table->unsignedBigInteger('equipo_2');
            $table->timestamps();

            $table->foreign('partido_id')->references('id')->on('partidos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('equipo_1')->references('id')->on('equipos')                
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('equipo_2')->references('id')->on('equipos')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_partidos');
    }
}
