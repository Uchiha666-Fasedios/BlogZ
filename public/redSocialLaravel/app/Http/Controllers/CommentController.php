<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
  public function __construct(){
     $this->middleware('auth');//este middleware hace q el resto de metodos sean privados
 }

public function save(Request $request){//este validate lo saqe de RegisterController autoHecho por laravel

// Validación
$validate = $this->validate($request, [//este validate lo saqe de RegisterController autoHecho por laravel
  'image_id' => 'integer|required',
  'content' => 'string|required'
]);

// Recoger datos
$user = \Auth::user();// la barra es para q me coja el namespace porqe Auth es una clase general echa por laravel q se invoca asi OBTENGO AL USUARIO LOGEADO
$image_id = $request->input('image_id');//lo del post ya lo ingreso aca
$content = $request->input('content');

// Asigno los valores a mi nuevo objeto a guardar
$comment = new Comment();//instancia la clase q es un modelo
$comment->user_id = $user->id;
$comment->image_id = $image_id;
$comment->content = $content;

// Guardar en la bd
$comment->save();//esto me lo guarda a la tabla de la base de datos save()esta echo por laravel y me ahorro de hacer input value etc..

// Redirección
return redirect()->route('image.detail', ['id' => $image_id])
         ->with([
          'message' => 'Has publicado tu comentario correctamente!!'
         ]);
}

public function delete($id){
  // Conseguir datos del usuario logueado
  $user = \Auth::user();

  // Conseguir objeto del comentario
  $comment = Comment::find($id);// con find($id) me saca un objeto de ese id, entonces voy a tener el comentario con ese id

  // Comprobar si soy el dueño del comentario o de la publicación
  if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){//$user->id es el id del logeado, $comment->user_id es el user_id del comentario acordarse q
      //$comment tiene un solo elemento entonces con esto comparas el usuario logeado con el user_id del comentario
    // y despues $comment->image->user_id la clase Comment llama al metodo image y ese metodo va a usar la clase Image y hace una relacion de image_id de comments y id de Image
//de eso ya puedo contar con user_id para comparar con el logeado ..resumido esos comentarios van a tener el user_id para pode comparar con el logeado
//RESUMEN=el user_id q a crado la imagen es igual al id del usuario identificado
    $comment->delete();//me elimina el comentario y ME LO ELIMINA DE LA BASE DE DATOS CON LA MAGIA DE LARAVEL

    return redirect()->route('image.detail', ['id' => $comment->image->id])//$comment->image->id esto me redirecciona con el parametro del id de la imagen ya q puedo invocar las propiedades en las tablas q se relacionan con la magia de laravel ORM
           ->with([
            'message' => 'Comentario eliminado correctamente!!'
           ]);
  }else{
    return redirect()->route('image.detail', ['id' => $comment->image->id])
           ->with([
            'message' => 'EL COMENTARIO NO SE HA ELIMINADO!!'
           ]);
  }
}


}
