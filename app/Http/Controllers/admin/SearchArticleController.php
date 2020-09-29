<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Theme;
use App\User;

class SearchArticleController extends Controller
{
    public function index(Request $request)
    {
    	$miga='Buscador Artículos';
    	$busqueda=$request->busqueda;//guardo lo q llega del input
    	$tema=Theme::where('nombre','like',"$busqueda")->first();//NO PONGO asi %$busqueda% con los porcentajes porqe esta ves quiero q se buqe no por delante ni por atras, exacta la palabra quiero.. Theme::where('nombre' si los algun nombre de tema.. 'like',"$busqueda" me da exactamente igual a $busqueda..->first() toma el primero q encuentra..
        $usuario=User::where('name','like',"$busqueda")->first();//aca lo mismo q arriba o sea me busca lo q llega del input si pongo un nombre de un usuario tiene q ser el nombre entero para q me busqe lo guarda en la variable
        if($usuario)//si este usuario es true o sea existe
        {
        	foreach($usuario->roles as $role)//bucle q para indagar los roles q tiene
            {
                if($role->nombre=="administrador" || $role->nombre=="moderador")
                {
                    // preguntamos si el usuario tiene articulos. $provincias = Provincia::has('anexos')->get();
	        		$articulos=$usuario->articles()->withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->get();//$usuario->articles()->withoutGlobalScope('activo') todos los articulos q tiene el usuario sin tener en cuenta el globalScope para q me de todo tanto activos como inactivos.. with(['user','theme']) para no gastar recursos y q vaya guardando los usuarios y los temas igual todos los articulos van a perteneser a un mismo usuario y tema pero poned eso para q no gaste recurso
	                return view('admin.articulos.buscador')->with(compact('miga','articulos'));
                }
            }
        }

    	if($tema)//si da true
    	{

    		$articulos=$tema->articles()->withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->get();//$tema->articles() todos los articulos q tiene ese tema
			return view('admin.articulos.buscador')->with(compact('miga','articulos'));
    	}
//este es por si no pone un usuario o un tema escrito exacto
    	$articulos=Article::withoutGlobalScope('activo')->with(['user','theme'])->where('titulo','like',"%$busqueda%")->orderBy('id','desc')->get();//se va buscar por el titulo del articulo
    	return view('admin.articulos.buscador')->with(compact('miga','articulos'));
    }
}

