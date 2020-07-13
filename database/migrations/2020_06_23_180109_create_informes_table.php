<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);

            $table->integer('id_ente_control')->unsigned();
            $table->integer('id_dependencia')->unsigned();
            $table->integer('id_evidencia')->unsigned();
            $table->integer('id_normativa')->unsigned();
            $table->integer('estado');
            $table->foreign('id_ente_control')->references('id')->on('entes');
            $table->foreign('id_dependencia')->references('id')->on('dependencias');
            $table->foreign('id_evidencia')->references('id')->on('evidencias');
            $table->foreign('id_normativa')->references('id')->on('normativas');
            $table->dateTime('fecha_entrega');
            $table->dateTime('fecha_final_entregas');
            $table->dateTime('fecha_creacion')->default(now());
            $table->dateTime('fecha_edicion');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informes');
    }
}
