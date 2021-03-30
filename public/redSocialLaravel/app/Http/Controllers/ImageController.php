<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;//para imagenes
use App\Image;//en la clase image cree el namespace aca lo invoco para poder usar ese modelo
use Illuminate\Support\Facades\Storage;//para las imagenes
use Illuminate\Support\Facades\File;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');//este middleware se creo automatico por laravel en HomeController y lo coloco acar para q no se pueda entrar a estos metodos sin estar logeado
  }

  public function create(){
		return view('image.create');
	}

  public function save(Request $request){//$request es cuando recibo de formularios de post

    //Validación
    $validate = $this->validate($request, [//este validate lo saqe de RegisterController autoHecho por laravel
      'description' => 'required',
      'image_path'  => 'required|image'//|image q solo sea una imagen lo controla laravel
    ]);

    // Recoger datos
    $image_path = $request->file('image_path');
    $description = $request->input('description');

    // Asignar valores nuevo objeto
    $user = \Auth::user();// la barra es para q me coja el namespace porqe Auth es una clase general echa por laravel q se invoca asi OBTENGO AL USUARIO LOGEADO
    $image = new Image();//obtengo el objeto imagen
    $image->user_id = $user->id;//seteo al id del logeado al user_id de la clase Image (modelo)
    $image->description = $description;//seteo la descripcion

    // Subir fichero
    if($image_path){
      $image_path_name = time().$image_path->getClientOriginalName();//time() me saca el tiempo el dia y la hora en unix q es irrepetible getClientOriginalName obtengo el nombre original cuando lo sube el usuario y lo hago unico
      Storage::disk('images')->put($image_path_name, File::get($image_path));//File::get con eso obtengo la imagen y con put la guardo en disk('images') en este caso
      $image->image_path = $image_path_name;//seteo la imagen
    }

    $image->save();//esto me lo guarda a la tabla de la base de datos save()esta echo por laravel y me ahorro de hacer input value etc..

    return redirect()->route('home')->with([ //lo redirecciono y creo una session q se va a ver una sola vez
      'message' => 'La foto ha sido subida correctamente!!'
    ]);
  }

  public function getImage($filename){
		$file = Storage::disk('images')->get($filename);
		return new Response($file, 200);//Response lo saqe de use Illuminate\Http\Response
	}

  public function detail($id){
		$image = Image::find($id);//find este metodo si le paso un id me va a sacar ese objeto

		return view('image.detail',[
			'image' => $image
		]);
	}

  public function delete($id){
    //para borrar la imagen hay q borrar sus comentarios los likes y todo o sea q necesito borrar de otras tablas tambien
		$user = \Auth::user();//obtengo al usuario logeado
		$image = Image::find($id);//obtengo la imagen del id q me llega
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
		$image = Image::find($id);//obtengo la imagen del id q me llega

		if($user && $image && $image->user->id == $user->id){//si estoy identificado y existe algo en $image y el id de la imagen tiene el mismo id de usuario q el id del logeado
			return view('image.edit', [
				'image' => $image
			]);
		}else{
			return redirect()->route('home');//lo redirecciona al inicio
		}
	}

	public function update(Request $request){
		//Validación
		$validate = $this->validate($request, [
			'description' => 'required',
			'image_path'  => 'image'
		]);

		// Recoger datos
		$image_id = $request->input('image_id');
		$image_path = $request->file('image_path');
		$description = $request->input('description');

		// Conseguir objeto image
		$image = Image::find($image_id);//concigo la imagen la fila esa
		$image->description = $description;//lo seteamos en la clase

		// Subir fichero
		if($image_path){
			$image_path_name = time().$image_path->getClientOriginalName();//time() me saca el tiempo el dia y la hora en unix q es irrepetible getClientOriginalName obtengo el nombre original cuando lo sube el usuario y lo hago unico
			Storage::disk('images')->put($image_path_name, File::get($image_path));//File::get con eso obtengo la imagen y con put la guardo en disk('images') en este caso
			$image->image_path = $image_path_name;//lo seteamos en la clase
		}

		// Actualizar registro
		$image->update();

		return redirect()->route('image.detail', ['id' => $image_id])//aca lo redirecciono a la vista de detalle con el id de la imagen como parametro
						 ->with(['message' => 'Imagen actualizada con exito']);//y lleva una sesion q dura una sola vez para el mensaje
	}

}
