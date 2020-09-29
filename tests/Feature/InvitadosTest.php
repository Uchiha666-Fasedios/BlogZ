<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitadosTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInvitadoNoPuedeAccederRutaHome()
    {
        $response = $this->get('/home');
        //$response->assertStatus(302);
        $response->assertRedirect('email/verify');//lo redirecciona aca es una ruta q fue creada por defecto por laravel de la verificacion de email
    }

    public function testInvitadoNoPuedeAccederRutaModerador()
    {
        $response = $this->get('moderador/articulos');
        //$response->assertStatus(302);
        $response->assertRedirect('/');//lo redirecciona aca por ser invitado no puede
    }

    public function testInvitadoNoPuedeAccederRutaAdmin()
    {
        $response = $this->get('admin/temas');
        //$response->assertStatus(302);
        $response->assertRedirect('/');//aca tampoco puede
    }

    /*---------------------------------------------------------------------*/

    public function testInvitadoNoPuedeVerTemaSuscripcion()
    {
        $usuario=factory(\App\User::class)->create();
        $tema=factory(\App\Theme::class)->create([
            'user_id'       =>  $usuario->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches',
            'suscripcion'   =>  '1'
        ]);
        $response = $this->get('/tema/coches');
        //$response->assertStatus(200);
        $response->assertSee('Para, Por favor!');
    }

    public function testInvitadoNoPuedeVerArticuloSuscripcion()
    {
        $usuario=factory(\App\User::class)->create();
        $tema=factory(\App\Theme::class)->create([
            'user_id'       =>  $usuario->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches',
            'suscripcion'   =>  '1'
        ]);
        $articulo=factory(\App\Article::class)->create([ // Si desactivamos el artículo da error porque no lo puede ver
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario->id
        ]);
        $response = $this->get('/buscador');
        //$response->assertStatus(200);
        //$response->assertSee('0 articulos'); // Probar otra cosa
        $response->assertDontSee(e($articulo->titulo));
    }

    public function testInvitadoNoPuedeVerArticuloNoActivo()
    {
        $usuario=factory(\App\User::class)->create();
        $tema=factory(\App\Theme::class)->create([
            'user_id'       =>  $usuario->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches'
        ]);
        $articulo=factory(\App\Article::class)->create([ // Si desactivamos el artículo da error porque no lo puede ver
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'activo'       =>  false,
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario->id
        ]);
        $response = $this->get('/tema/coches');
        //$response->assertStatus(200);
        //$response->assertSee('0 articulos'); // Probar otra cosa
        $response->assertDontSee(e($articulo->titulo));
    }
}
