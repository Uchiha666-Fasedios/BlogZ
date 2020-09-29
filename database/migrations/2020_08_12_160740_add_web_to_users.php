<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWebToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::table('users', function (Blueprint $table) {
            //
       // });

        Schema::table('users',function(Blueprint $table){//q se cree en la taba users
            $table->string('web')->nullable()->after('alias');//string('web') q va a ser string el campo y se va  a llamar web.. default('pepito-grillo') q va tener un valor por default no lo puse.. q va ser nulo ..after('alias') y el campo va a estar despues de alias
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('users', function (Blueprint $table) {
            //
       // });

       Schema::table('users',function(Blueprint $table){
        $table->dropColumn('web');//elimina la columna
    });
    }
}
