<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado', function (Blueprint $table) {
            $table->integer('total');
            $table->unsignedInteger('partido_eleccion_id');
            $table->unsignedInteger('mesa_id');
            $table->primary(array('partido_eleccion_id', 'mesa_id'));
            $table->foreign('partido_eleccion_id')->references('id')->on('partido_eleccion')->onDelete('cascade');
            $table->foreign('mesa_id')->references('id')->on('mesa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultado');
    }
}
