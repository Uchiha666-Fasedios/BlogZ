<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('alias')->unique();  // añadido
            $table->boolean('bloqueado')->default(false);
            $table->boolean('es_admin')->default(false);//por defecto en false o sea en 0
            $table->timestamp('email_verified_at')->nullable();//q puede ser nulo
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();//q contenga la ultima fecha de modificacion de dicho registro
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');//elimina tabla
    }
}
