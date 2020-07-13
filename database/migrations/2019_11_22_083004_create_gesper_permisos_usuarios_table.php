<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGesperPermisosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gesper_permisos_usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('gesper_proceso_id');
            $table->boolean('ver')->default(false);
            $table->boolean('agregar')->default(false);
            $table->boolean('editar')->default(false);
            $table->boolean('imprimir')->default(false);
            $table->boolean('exportar')->default(false);
            $table->boolean('eliminar')->default(false);
            $table->date('fecha_vencimiento')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gesper_proceso_id')->references('id')->on('gesper_procesos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gesper_permisos_usuarios');
    }
}
