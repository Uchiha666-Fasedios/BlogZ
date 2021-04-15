<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;//para imagenes
use App\Video;//en la clase image cree el namespace aca lo invoco para poder usar ese modelo
use Illuminate\Support\Facades\Storage;//para las imagenes
use Illuminate\Support\Facades\File;
use App\Comment;
use App\Like;

class VideoController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');//este middleware se creo automatico por laravel en HomeController y lo coloco acar para q no se pueda entrar a estos metodos sin estar logeado
  }

  public function create(){
		return view('video.create');
	}

  public function save(Request $request){//$request es cuando recibo de formularios de post

    //Validación
    $validate = $this->validate($request, [//este validate lo saqe de RegisterController autoHecho por laravel
	  'description' => 'required',
	  'video_path'  => 'mimes:mp4,mov,ogg | max:20000',//|image q solo sea una imagen lo controla laravel

    ]);

    // Recoger datos
    $video_path = $request->file('video_path');
    $description = $request->input('description');

    // Asignar valores nuevo objeto
    $user = \Auth::user();// la barra es para q me coja el namespace porqe Auth es una clase general echa por laravel q se invoca asi OBTENGO AL USUARIO LOGEADO
    $video = new Video();//obtengo el objeto imagen
    $video->user_id = $user->id;//seteo al id del logeado al user_id de la clase Video (modelo)
    $video->description = $description;//seteo la descripcion

	// Subir fichero




    if($video_path){
      $video_path_name = time().$video_path->getClientOriginalName();//time() me saca el tiempo el dia y la hora en unix q es irrepetible getClientOriginalName obtengo el nombre original cuando lo sube el usuario y lo hago unico
	  //Storage::disk('videos')->put($video_path_name, File::get($video_path));//File::get con eso obtengo la imagen y con put la guardo en disk('images') en este caso
	  Storage::disk('images')->put($video_path_name, File::get($video_path));//File::get con eso obtengo la imagen y con put la guardo en disk('images') en este caso
      $video->video_path = $video_path_name;//seteo la imagen
    }

    $video->save();//esto me lo guarda a la tabla de la base de datos save()esta echo por laravel y me ahorro de hacer input value etc..

    return redirect()->route('home')->with([ //lo redirecciono y creo una session q se va a ver una sola vez
      'message' => 'El video ha sido subido correctamente!!'
    ]);
  }

  public function getVideo($filename){
		$file = Storage::disk('images')->get($filename);
		return $file;//Response lo saqe de use Illuminate\Http\Response
	}

  public function detail($id){
		$video = Video::find($id);//find este metodo si le paso un id me va a sacar ese objeto

		return view('video.detail',[
			'video' => $video
		]);
	}














  public function delete($id){
    //para borrar la imagen hay q borrar sus comentarios los likes y todo o sea q necesito borrar de otras tablas tambien
		$user = \Auth::user();//obtengo al usuario logeado
		$image = Video::find($id);//obtengo la imagen del id q me llega
		$comments = Comment::where('image_id', $id)->get();//obtengo el o los comentarios q sean image_id igual a id
		$likes = Like::where('image_id', $id)->get();//y los likes

		if($user && $image && $image->user->id == $user->id){//si estoy identificado y existe algo en $image y el id de la imagen tiene el mismo id de usuario q el id del logeado

			// Eliminar comentarios
			if($comments && count($comments) >= 1){//si hay algo
				foreach($comments as $comment){
					$comment->delete();//borro todos los comentarios
				}
			}

			// Eliminar los likes
			if($likes && count($likes) >= 1){//si hay algo
				foreach($likes as $like){
					$like->delete();//boroo todos los likes
				}
			}

			// Eliminar ficheros de imagen
			Storage::disk('images')->delete($image->image_path);//elimino la imagen de la carpeta y de la tabla images

			// Eliminar registro imagen
			$image->delete();

			$message = array('message' => 'La imagen se ha borrado correctamente.');//creo el mensaje
		}else{
			$message = array('message' => 'La imagen no se ha borrado.');//creo el mensaje
		}

		return redirect()->route('home')->with($message);//redirecciono a home q es la de inicio y con el mensaje
	}

	public function edit($id){
		$user = \Auth::user();//obtengo al usuario logeado
		$video = Video::find($id);//obtengo la imagen del id q me llega

		if($user && $video && $video->user->id == $user->id){//si estoy identificado y existe algo en $image y el id de la imagen tiene el mismo id de usuario q el id del logeado
			return view('video.edit', [
				'video' => $video
			]);
		}else{
			return redirect()->route('home');//lo redirecciona al inicio
		}
	}

	public function update(Request $request){
		//Validación
		$validate = $this->validate($request, [
			'description' => 'required',
			'video_path'  => 'required'//|image q solo sea una imagen lo controla laravel
		]);

		// Recoger datos
		$video_id = $request->input('image_id');
		$video_path = $request->file('video_path');
		$description = $request->input('description');

		// Conseguir objeto image
		$video = Video::find($video_id);//concigo la imagen la fila esa
		$video->description = $description;//lo seteamos en la clase

		// Subir fichero
		if($video_path){
			$video_path_name = time().$video_path->getClientOriginalName();//time() me saca el tiempo el dia y la hora en unix q es irrepetible getClientOriginalName obtengo el nombre original cuando lo sube el usuario y lo hago unico
			Storage::disk('images')->put($video_path_name, File::get($video_path));//File::get con eso obtengo la imagen y con put la guardo en disk('images') en este caso
			$video->video_path = $video_path_name;//lo seteamos en la clase
		}

		// Actualizar registro
		$video->update();

		return redirect()->route('video.detail', ['id' => $video_id])//aca lo redirecciono a la vista de detalle con el id de la imagen como parametro
						 ->with(['message' => 'Video actualizada con exito']);//y lleva una sesion q dura una sola vez para el mensaje
	}

}
