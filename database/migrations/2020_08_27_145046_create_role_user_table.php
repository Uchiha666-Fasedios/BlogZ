<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');//unsignedBigInteger se va crear un int q no permite negativos el campo se va llamar user_id
            $table->unsignedBigInteger('role_id');//unsignedBigInteger se va crear un int q no permite negativos el campo se va llamar role_id
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');////el user_id creado va ser una llave foranea y va ser referencia a el id de la tabla users
            $table->foreign('role_id')->references('id')->on('roles');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
