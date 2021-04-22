<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commentary;
use App\Article;
use Illuminate\Support\Facades\Gate;

class CommentaryController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','verified'], ['except' => 'comentariosMostrarAxios']);//q esto auth afecta solo a estos menos a comentariosMostrarAxios
    }

    public function storeAxios(Request $request)
    {
        $rules=[
            'texto'=>'required|max:1000',//q maximo 1000
        ];

        $this->validate($request, $rules);

        sleep(3);//un efecto de retraso

        $comentario=new Commentary();//creo el objeto
        $comentario->comentario=$request->texto;//meto el comentario
        $comentario->article_id=$request->articulo_id;//meto el id del articulo
        $comentario->user_id=auth()->user()->id;//meto el id del usuario
        $comentario->save();//guardo en la base de datos
    }

    public function destroyAxios($id_comentario)
    {
        $comentario=Commentary::findOrFail($id_comentario);
        if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('moderador')) // Administrador o Moderador pueden borrar todos los comentarios
        {
            $comentario->forceDelete();
        }else{//es solo usuario
            //Gate con eso le decimos al usuario le permitimos eliminar el comentario 
            if (Gate::allows('comentario-borrar', $comentario)) { // Si el comentario pertenece al usuario puede borrarse
    		    $comentario->forceDelete();
    		}
        }
    }

    public function comentariosMostrarAxios($articulo_id)
    {
        $articulo=Article::findOrFail($articulo_id);//findOrFail encuentra el articulo con tal id..
        foreach($articulo->commentaries->sortByDesc('id') as $comentario)//del mas reciente al mas antiguo
        {
            echo '<div id="'.$comentario->id.'" class="news__inner">';
                if(auth()->user())
                {
                    if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('moderador') || auth()->user()->id==$comentario->user_id)//auth()->user()->id==$comentario->user_id si el usuario autenticado es igual al id_user de la tabla comentarios
                    {
                        echo '<a href="#" onclick="eliminarComentario('.$comentario->id.')"><img style="float:right;" width="20px" src="'.asset('imagenes/admin/eliminar.png').'"></a>';
                    }
                }
                echo '<p><i>Escrito por : <strong>'.$comentario->user->alias.' | '.$comentario->created_at->diffForHumans().'</strong></i></p>';
                echo '<p>'.$comentario->comentario.'</p>';//el comentario
                echo '<hr>';
            echo '</div>';
        }
    }
}
