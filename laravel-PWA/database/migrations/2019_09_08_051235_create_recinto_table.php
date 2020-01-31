<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecintoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recinto', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre');
            $table->text('direccion');
            $table->unsignedInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recinto');
    }
}
