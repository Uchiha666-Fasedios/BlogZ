<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');//este middleware se creo automatico por laravel en HomeController y lo coloco acar para q no se pueda entrar a estos metodos sin estar logeado
  }

  public function index(){
		$user = \Auth::user();
		$likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);//me saca los likes del usuario identificado

		return view('like.index',[
			'likes' => $likes
		]);
	}

	public function like($image_id){
		// Recoger datos del usuario y la imagen
		$user = \Auth::user();

		// Condicion para ver si ya existe el like y no duplicarlo
		$isset_like = Like::where('user_id', $user->id)//le ingreso al objeto lo q este en la tabla likes donde el user_id sea igual al id del logeado y igual a la $image_id
				            ->where('image_id', $image_id)
							->count();//me saca la cantidad, si hubiera puest get() me sacaba las filas con los datos

		if($isset_like == 0){//si es 0 es porqe no existe y entro al if
			$like = new Like();
			$like->user_id = $user->id;
			$like->image_id = (int)$image_id;//(int)casteo para q entre a la base de datos como int si no entra como string

			// Guardar
			$like->save();//estoy guardando el user_id del usuario logeado y el image_id de la imagen en la tabla like

			return response()->json([//public function like($image_id){ al ser un metodo q va ser consultado por ajax me conviene devolver un json, response son las "respuestas" que nos debe devolver Laravel ante cualquier solicitud que se realice al servidor
				'like' => $like//me devuelve el objeto q he borrado
			]);
		}else{
			return response()->json([
				'message' => 'El like ya existe'
			]);
		}

	}

	public function dislike($image_id){
		// Recoger datos del usuario y la imagen
		$user = \Auth::user();

		// Condicion para ver si ya existe el like y no duplicarlo
		$like = Like::where('user_id', $user->id)
				            ->where('image_id', $image_id)
							->first();//me va permitir sacar un solo objeto de la base de datos

		if($like){//si existe

			// Eliminar like
			$like->delete();

			return response()->json([
				'like' => $like,//me devuelve el objeto q he borrado
				'message' => 'Has dado dislike correctamente'
			]);
		}else{
			return response()->json([
				'message' => 'El like no existe'
			]);
		}
	}

}
