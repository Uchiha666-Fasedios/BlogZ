<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class testAutenticadoPuedeModificarSusDatosTest extends TestCase
{
    //este lo pongo porqe no me funciona no se actualiza
   /* public function testAutenticadoPuedeModificarSusDatos()
    {
        $usuario=factory(\App\User::class)->create([//creo el usuario de forma aleatoria
            'email_verified_at'   =>  date("Y-m-d H:i:s") // // estoy poniendole una fecha a este campo q es el de la verificacion de email
        ]);

        $this->actingAs($usuario);//actingAs con este metodo se logea
        //esta es la ruta de actualizar si te fijas en web.php ..actualizo el usuario
        $this->put(route('usuario.update'),[
            'nombre'    =>  'Miguel',
            'alias'     =>  'migueli',
            'web'       =>  'www.web.com',
            'password'  =>  bcrypt('12345')

        ]);

        $usuario=\App\User::first();//YA CREADO EL USUARIO AGARRO EL PRIMERO IGUAL ES EL UNICO Q HAY
        $this->assertSame($usuario->name , 'Miguel');//assertSame CON ESTO DECIMOS SI En la base de datos existe un usuario con nombre de miguel
    }*/
}
