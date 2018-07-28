<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('evento_id')->unsigned();
            $table->integer('entrada_id')->unsigned();
            $table->boolean('asistido');
            $table->boolean('pagado');
            $table->timestamps();
        });
                
        Schema::table('registros', function($table) {
        $table->foreign('usuario_id')->references('id')->on('users');
        $table->foreign('evento_id')->references('id')->on('eventos');
        $table->foreign('entrada_id')->references('id')->on('entradas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
