<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->string('titulo',100);
            $table->decimal('latitud');
            $table->decimal('longitud');
            $table->string('descripcion',500);
            $table->date('fechaInicio');
            $table->date('fechaFin');   
            $table->string('nombreOrganizador',100);
            $table->string('descripcionOrganizador',800);
            $table->string('Direccion',500);
            $table->timestamps();
        });
        Schema::table('eventos', function($table) {
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
