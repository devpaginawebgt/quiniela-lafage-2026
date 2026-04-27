<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->integer('posicion')->nullable();
            $table->string('titulo_posicion');
            $table->string('nombre');
            $table->string('imagen');
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('line_id');
            $table->foreign('line_id')
                ->references('id')
                ->on('lines')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premios');
    }
}
