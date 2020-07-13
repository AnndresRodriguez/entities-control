<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('responsable', 50);
            $table->string('correo_responsable', 50);
            // $table->integer('id_informe')->unsigned();
            // $table->foreign('id_informe')->references('id')->on('informes');
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
        Schema::dropIfExists('dependencias');
    }
}
