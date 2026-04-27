    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo_iso');
            $table->string('imagen');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('grupo');
            $table->integer('goles_favor')->default(0);
            $table->integer('goles_contra')->default(0);
            $table->integer('partidos_jugados')->default(0);
            $table->integer('partidos_ganados')->default(0);
            $table->integer('partidos_perdidos')->default(0);
            $table->integer('partidos_empatados')->default(0);
            $table->integer('puntos')->default(0);
            $table->timestamps();

            $table->foreign('grupo')
                ->references('id')
                ->on('grupos')
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
        Schema::dropIfExists('equipos');
    }
}
