<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('codigo_id')
                ->nullable()
                ->constrained('codigos')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->string('nombres');
            $table->string('apellidos');
            $table->string('image')->nullable();
            $table->string('numero_documento');
            $table->string('email')->unique();

            $table->foreignId('pais_id')
                ->constrained('countries')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->integer('puntos')->index()->default(0);

            $table->foreignId('user_type_id')
                ->constrained('user_types')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreignId('line_id')
                ->constrained('lines')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->string('colegiado')->nullable();

            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->string('branch')->nullable();

            $table->integer('status_user')->index()->default(1);
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('accepted_terms_version');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}