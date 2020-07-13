<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlarmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alarmas', function (Blueprint $table) {
            $table->increments('id');

            // $table->integer('id_anio')->unsigned();
            // $table->integer('id_mes')->unsigned();
            // $table->integer('id_dia')->unsigned();

            // $table->foreign('id_anio')->references('id')->on('anios');
            // $table->foreign('id_mes')->references('id')->on('mes');
            // $table->foreign('id_dia')->references('id')->on('dias');
            $table->dateTime('fecha_hora_alarma');
            $table->integer('id_informe')->unsigned();
            // $table->foreign('id_informe')->references('id')->on('informes');
            // $table->dateTime('fecha_creacion')->default(now());
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
        Schema::dropIfExists('alarmas');
    }
}
