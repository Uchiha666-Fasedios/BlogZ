<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;//con esto refresco todo y las tablas qedan vacias nuevamente

class RutasInvitadosTest extends TestCase
{
   use RefreshDatabase;//con esto refresco todo y las tablas qedan vacias nuevamente
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRutaIndex() //se le pone test para ssaber q es un test
    {
        $response = $this->get('/'); //si voy a esta ruta a ver q pasa

        $response->assertStatus(200);//resivo este mensaje cuando ejecuto la prueba 200 q esta ok
    }

    public function testRutaBuscador()
    {
        $response = $this->get('/buscador');//si voy a esta ruta a ver q pasa

        $response->assertStatus(200);//resivo este mensaje cuando ejecuto la prueba 200 q esta ok
    }

    public function testRutaTema()
    {
        $usuario=factory(\App\User::class)->create();//con solo poner esto crearia un usuario ya q factories/UserFactory.php ya esta echo y configurado
//aca creo el tema fijate en ThemeFactory.php q esta ya echo todito
        $tema=factory(\App\Theme::class)->create([
            'user_id'   =>  $usuario->id,
            'nombre'    =>  'Putas',
            'slug'      =>  'putas'
        ]);

        $response = $this->get('/tema/putas'); //mostraria articulos del tema si te fijas en la ruta es asi tema/{tema} entonce pongo coche q es el tema q he creado

        $response->assertStatus(200); //espero algo positivo de mensaje

    }


}
