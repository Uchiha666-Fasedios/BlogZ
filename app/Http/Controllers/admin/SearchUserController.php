<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SearchUserController extends Controller
{
    public function index(Request $request)
    {
    	$miga='Buscador de Usuarios';
    	$busqueda=$request->busqueda;
    	$usuariosBD=User::with('roles')->get();
    	//$usuariosBD=User::all();de esta manera se puede pero hace mas consultas a la base de datos consume mas
    	if($busqueda=="moderadores")//aca es por si pongo en el buscador moderadores para q me busqe todos los moderadores
    	{
	    	$usuarios=collect();//hago una coleccion
	    	foreach($usuariosBD as $usuario)//voy haciendo el bucle con todos los usuarios de la base de datos
	    	{
	    		if($usuario->hasRole('moderador'))//si el usuario es moderador
	    			$usuarios->push($usuario);//lo guardo en la coleccion
	    	}
	    	return view('admin.usuarios.buscador')->with(compact('miga','usuarios'));
    	}

    	$usuarios=User::where('alias','like',"%$busqueda%")->orWhere('email','like',"%$busqueda%")->orWhere('name','like',"%$busqueda%")->get();//se va a comparar con el alias el email y el name del usuario
    	return view('admin.usuarios.buscador')->with(compact('miga','usuarios'));
    }
}
