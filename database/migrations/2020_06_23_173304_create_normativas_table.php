<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNormativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normativas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url_normativa', 100);
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
        Schema::dropIfExists('normativas');
    }
}
