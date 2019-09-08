<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipanteEleccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_eleccion', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('participante_id');
            $table->unsignedInteger('eleccion_id');
            $table->foreign('participante_id')->references('id')->on('participante')->onDelete('cascade');
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
        Schema::dropIfExists('participante_eleccion');
    }
}
