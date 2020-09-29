<?php

namespace App\Http\Controllers\moderador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchArticleController extends Controller
{
    public function index(Request $request)
    {
	    $miga='Buscador Artículos';
	    $busqueda=$request->busqueda;
	    $usuario=auth()->user();
	    $articulos=$usuario->articles()->withoutGlobalScope('activo')->with(['user','theme'])->where('titulo','like',"%$busqueda%")->orderBy('id','desc')->get(); //me trae los articulos creados por el usuario o sea por el moderador q no tenga en cuenta el globalScope y con esto ->with(['user','theme']) me trae los temas y los usuarios o sea del moderador se pone para ahorrar recursos en las vistas ..->where('titulo','like',"%$busqueda%") bue ya teneid q saberlo query de busqeda referente al titulo de los articulos
	    return view('moderador.articulos.buscador')->with(compact('miga','articulos'));
	}
}
