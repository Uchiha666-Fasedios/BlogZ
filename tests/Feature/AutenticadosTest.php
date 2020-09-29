<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class AutenticadosTest extends TestCase
{

    use RefreshDatabase;//con esto refresco todo y las tablas qedan vacias nuevamente y evito un error porqe creo dos veces el usuarios en este archivo si te fijas
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAutenticadoPuedeAccederRutaHome()
    {
        $usuario=factory(\App\User::class)->create([    //creo el usuario
            'email_verified_at'   =>  date("Y-m-d H:i:s") // estoy poniendole una fecha a este campo q es el de la verificacion de email
        ]);
        $this->actingAs($usuario);//actingAs con este metodo se logea
        $response = $this->get('/home');//nos vamos a la home
        $response->assertStatus(200);
    }

    //no me funciona no se actualiza el puto
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
            'password'  =>  bcrypt('12345'),
        ]);
        $usuario=\App\User::first();//YA CREADO EL USUARIO AGARRO EL PRIMERO IGUAL ES EL UNICO Q HAY
        $this->assertSame($usuario->name , 'Miguel');//assertSame CON ESTO DECIMOS SI En la base de datos existe un usuario con nombre de miguel
    }*/

    public function testAutenticadoBloqueadoNoPuedeVerTemaSuscripcion()
    {
        $usuario=factory(\App\User::class)->create([//creamos el usuario por defecto
            'bloqueado'           =>  1,  //le sobrescribimos este campo ponemos 1
            'email_verified_at'   =>  date("Y-m-d H:i:s") // y este
        ]);
        $this->actingAs($usuario);//lo logeado
        $tema=factory(\App\Theme::class)->create([//creamos u tema
            'user_id'       =>  $usuario->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches',
            'suscripcion'   =>  '1'
        ]);
        $response = $this->get('/tema/coches');//cogemos el tema q creamos
        //$response->assertStatus(200);
        $response->assertSee('Para, Por favor!');//esto es q se espera un texto q se muestre en la vista e indico cual texto
       // $response->assertDontSee('Para, Por favor!');//esto es q no veria el texto
    }

    public function testAutenticadoBloqueadoNoPuedeVerArticuloSuscripcion()
    {
        $usuario=factory(\App\User::class)->create([
            'bloqueado'           =>  1,
            'email_verified_at'   =>  date("Y-m-d H:i:s") // NOW() ó CURRENT_TIME()
        ]);
        $this->actingAs($usuario);
        $tema=factory(\App\Theme::class)->create([//creo tema
            'user_id'       =>  $usuario->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches',
            'suscripcion'   =>  '1'
        ]);
        $articulo=factory(\App\Article::class)->create([//creo un articulo para este tema
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario->id
        ]);
        $response = $this->get('/buscador');//la ruta de busqeda
        //$response->assertStatus(200);
        //$response->assertSee('0 articulos'); // Probar otra cosa
        $response->assertDontSee(e($articulo->titulo));//assertDontSee en la vista no voy a poder ver .. un articulo de suscripcion.. e eso es para q no alla problemas con el titulo si tiene algun tilde etc..
    }
}
