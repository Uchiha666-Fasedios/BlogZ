<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RutasAdministradorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdministradorPuedeAccederZonaAdministrador()
    {
        $usuario=factory(\App\User::class)->create([  
            'email_verified_at'   =>  date("Y-m-d H:i:s") // NOW() ó CURRENT_TIME()
        ]);
        $tema=factory(\App\Theme::class)->create([
            'user_id'       =>  $usuario->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches',
            'suscripcion'   =>  '1'   
        ]);
        factory(\App\Role::class)->create([
            'id'        =>  1,  
            'nombre'    =>  'usuario'
        ]);
        factory(\App\Role::class)->create([
            'id'        =>  2,   
            'nombre'    =>  'moderador'
        ]);
        factory(\App\Role::class)->create([
            'id'        =>  3,   
            'nombre'    =>  'administrador'
        ]);
        $usuario->roles()->sync([1,3]);
        $this->actingAs($usuario);
        $response = $this->get('admin/temas');
        $response->assertStatus(200);
    }
}
