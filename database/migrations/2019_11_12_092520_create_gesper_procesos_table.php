<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGesperProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gesper_procesos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('gesper_modulo_id');
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('gesper_modulo_id')->references('id')->on('gesper_modulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gesper_procesos');
    }
}
