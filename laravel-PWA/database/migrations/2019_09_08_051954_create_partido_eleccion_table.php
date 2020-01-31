<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidoEleccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partido_eleccion', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('partido_id');
            $table->unsignedInteger('eleccion_id');
            $table->foreign('partido_id')->references('id')->on('partido')->onDelete('cascade');
            $table->foreign('eleccion_id')->references('id')->on('eleccion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partido_eleccion');
    }
}
