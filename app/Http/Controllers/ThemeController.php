<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theme;


class ThemeController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        //
    }


    public function show(theme $tema)  //aca tengo el parametro $tema q es typo theme
    {

	/*$articulos=$tema->articles()->where('activo', '=' , 1)->with(['images'])->orderBy('id','desc')->paginate(6);
		return view('tema.articulos')->with(compact('tema','articulos'));*/
		$usuarioAutenticado=true;
        $usuarioBloqueado=false;
        $usuarioVerificado=true;

        if($tema->suscripcion) //si en la tabla themes el campo suscripcion es 1 o true entra al if
        {
            if(auth()->check())//si el usuario esta autenticado
            {

                if(!is_null(auth()->user()->email_verified_at))//si email_verified_at es diferente a null)
            {

                if(auth()->user()->bloqueado)
                {
                    $usuarioBloqueado=true;
                return view('tema.articulos')->with(compact('tema','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));
                }

                    //$articulos=$tema->articles()->ArticulosActivos()->with(['images'])->orderBy('id','desc')->paginate(6);//ArticulosActivos() esta en modelo Article
                    $articulos=$tema->articles()->with(['images'])->orderBy('id','desc')->paginate(6);//YA NO LE HACE FALTA PONER ArticulosActivos() GRACIAS A Global Scope Q SE CREO EN Article

                    return view('tema.articulos')->with(compact('tema','articulos','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));

            }
            $usuarioVerificado=false;
            return view('tema.articulos')->with(compact('tema','articulos','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));

            }

            $usuarioAutenticado=false;
        return view('tema.articulos')->with(compact('tema','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));
        }




        //$temasTodos=Theme::all();//ponemos todos los temas
        //$tema=Theme::find($theme_id);//con el id llamamos un tema en particular
        //$tema=Theme::where('slug', '=', $slug)->first();//first() coge el primer resultado
        //$articulos=$tema->articles()->where('activo', '=', 1)->with(['images'])->orderBy('id','desc')->get();
        $articulos=$tema->articles()->with(['images'])->orderBy('id','desc')->paginate(6);//$tema->articles() desde el modelo thema invoco los articulos ..scopeArticulosActivos() esta en modelo Article Ya NO HACE FALTA INVOCARLO.. with(['images']) carga una sesion llamada images (coleccion de objetos)q se ve por unica vez.. sortByDesc('id') si quiero usarlo con eloquent con get() cogelos si o si ay q ponerlo
        return view('tema.articulos')->with(compact('tema','articulos','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));//retornamos una vista carpeta tema archivo articulos
        //compact Crear un array que contiene variables y sus valores
        // with es una session q solo se muestra una vez
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
