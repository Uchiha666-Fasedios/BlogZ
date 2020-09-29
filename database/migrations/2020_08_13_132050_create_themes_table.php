<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->default(1);//unsignedBigInteger se va crear un int q no permite negativos el campo se va llamar user_id y por defecto va tener 1
            $table->foreign('user_id')->references('id')->on('users');//el user_id creado va ser una llave foranea y va ser referencia a el id de la tabla users
            $table->string('nombre');
            $table->string('slug')->index()->unique();//index()Es la forma de decirle a Laravel Migration que agregue índices a esa columna, para obtener resultados más rápidos al buscar en esa columna en particular.se le va a agregar una llave foranea porqe es un campo de busqeda
            $table->boolean('destacado')->default(false);
            $table->boolean('suscripcion')->default(false);
            $table->softDeletes();//esta se usa para el borrado logico
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
