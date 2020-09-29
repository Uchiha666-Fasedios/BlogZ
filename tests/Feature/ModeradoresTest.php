<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModeradoresTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testModeradorPuedeAccederZonaModerador()
    {
        $usuario=factory(\App\User::class)->create([  
            'email_verified_at'   =>  date("Y-m-d H:i:s") // NOW() ó CURRENT_TIME()
        ]);
        factory(\App\Role::class)->create([  
            'nombre'    =>  'usuario'
        ]);
        factory(\App\Role::class)->create([  
            'nombre'    =>  'moderador'
        ]);
        factory(\App\Role::class)->create([  
            'nombre'    =>  'administrador'
        ]);
        $usuario->roles()->sync([1,2]);
        $this->actingAs($usuario);
        $response = $this->get('moderador/articulos');
        $response->assertStatus(200);
    }

    public function testModeradorNoPuedeAccederZonadmin()
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
        $usuario->roles()->sync([1,2]);
        $this->actingAs($usuario);
        $response = $this->get('admin/temas');
        $response->assertStatus(403); // Cuando se loguea un usuario no tiene una reedireción, sino que le sale un mensaje de no tiene autorización (403).
    }

    public function testModeradorPuedeCrearArticulos()
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

        $usuario->roles()->sync([1,2]); // Si ponenmos 1, un usuario autenticado no puede crear artículo.
        $this->actingAs($usuario);
        $response=$this->post(route('moderador.articulos.store'),[
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario->id, 
        ]);
        
        $this->assertSame(\App\Article::count(),1);
    }

    public function testModeradorPuedeActualizarSusArticulos()
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

        $articulo=factory(\App\Article::class)->create([
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario->id    
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

        $usuario->roles()->sync([1,2]); // Si ponenmos 1, un usuario autenticado no puede crear artículo.
        $this->actingAs($usuario);
        $response=$this->put(route('moderador.articulos.update', $articulo->id),[
            'titulo'       =>  'Editado', 
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario->id    
        ]);

        $articulo=\App\Article::first();
        $this->assertSame($articulo->titulo,'Editado');
    }

    public function testModeradorNoPuedeActualizarOtrosArticulos()
    {
        $usuario=factory(\App\User::class)->create([  
            'email_verified_at'   =>  date("Y-m-d H:i:s") // NOW() ó CURRENT_TIME()
        ]);

        $usuario2=factory(\App\User::class)->create([  
            'email_verified_at'   =>  date("Y-m-d H:i:s") // NOW() ó CURRENT_TIME()
        ]);

        $tema=factory(\App\Theme::class)->create([
            'user_id'       =>  $usuario2->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches',
            'suscripcion'   =>  '1'   
        ]);

        $articulo=factory(\App\Article::class)->create([
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario2->id    
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

        $usuario->roles()->sync([1,2]); // Si ponenmos 1, un usuario autenticado no puede crear artículo.
        $this->actingAs($usuario);
        $response=$this->put(route('moderador.articulos.update', $articulo->id),[
            'titulo'       =>  'Editado', 
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario2->id    
        ]);

        $articulo=\App\Article::first();
        $this->assertNotSame($articulo->titulo,'Editado');
    }

    /*-----------------------------------------------------------------------------------------------------------------*/

    public function testModeradorPuedeEliminarSusArticulos()
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

        $articulo=factory(\App\Article::class)->create([
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario->id    
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

        $usuario->roles()->sync([1,2]); // Si ponenmos 1, un usuario autenticado no puede crear artículo.
        $this->actingAs($usuario);
        $this->delete(route('moderador.articulos.destroy', $articulo->id));

        $articulo=\App\Article::first();
        $this->assertNull($articulo);
    }

    public function testModeradorNoPuedeEliminarOtrosArticulos()
    {
        $usuario=factory(\App\User::class)->create([  
            'email_verified_at'   =>  date("Y-m-d H:i:s") // NOW() ó CURRENT_TIME()
        ]);

        $usuario2=factory(\App\User::class)->create([  
            'email_verified_at'   =>  date("Y-m-d H:i:s") // NOW() ó CURRENT_TIME()
        ]);

        $tema=factory(\App\Theme::class)->create([
            'user_id'       =>  $usuario2->id,
            'nombre'        =>  'Coches',
            'slug'          =>  'coches',
            'suscripcion'   =>  '1'   
        ]);

        $articulo=factory(\App\Article::class)->create([
            'titulo'       =>  'Mercedes',
            'contenido'    =>  'Este es un mercedes',
            'theme_id'     =>  $tema->id,
            'user_id'      =>  $usuario2->id    
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

        $usuario->roles()->sync([1,2]); // Si ponenmos 1, un usuario autenticado no puede crear artículo.
        $this->actingAs($usuario);
        $this->delete(route('moderador.articulos.destroy', $articulo->id));

        $articulo=\App\Article::first();
        $this->assertNotNull($articulo);
    }

}
