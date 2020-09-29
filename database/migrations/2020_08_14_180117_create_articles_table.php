<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->text('contenido')->nullable();
            $table->boolean('activo')->default(true);//para q los articulos esten activados por defecto
            $table->unsignedBigInteger('theme_id');//crea el theme_id
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');//theme_id va tener clave foranea y hace referencia a el id de la tabla themes porqe cada tema va tener un articulo ..->onDelete('cascade') para q cuando borre un tema se borre todo lo relacionado con el o sea estos articulos
            $table->unsignedBigInteger('user_id');//se crea este user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//hace referencia al id de la tabla users porque cada usuario va tener tal articulo
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
        Schema::dropIfExists('articles');
    }
}
