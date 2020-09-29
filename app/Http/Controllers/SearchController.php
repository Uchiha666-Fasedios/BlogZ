<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Article;

class SearchController extends Controller
{

    public function index(Request $request)//Request $request se utiliza PARA RECOGER LA INFORMACION Q LLEGA DE LOS FORMULARIOS
    {
       /* $busqueda=$request->busqueda;//request con esto invoco lo q llega del formulario busqueda es el nombre del input
    	//$articulos=Article::where('titulo','like',"%$busqueda%")->where('activo','=',1)->with(['images'])->orderBy('id','desc')->get();
    	$articulos=Article::where('titulo','like',"%$busqueda%")->ArticulosActivos()->with(['images'])->orderBy('id','desc')->get(); //ArticulosActivos esto es un queryscope esta en el modelo Article se coloca sin scope.. with(['images'] esto llama a images() de Article.. lo puedo poner con () o sin  y como es una session lo muestra una sola vez en articulos.blade.php
        return view('buscador')->with(compact('articulos'));*/



        $articulosPermitidos=collect();//creo una variable de typo colleccion
        $busqueda=$request->busqueda;
        $usuarioVerificado=true;

        if(auth()->check())  //si esta autenticado entro
        {

            if(!is_null(auth()->user()->email_verified_at))//si email_verified_at es diferente a null)
            {

            if(!auth()->user()->bloqueado)//si esta autenticado pero blokeado (o sea los usuarios q no esten blokeados q tengan 0)
                {

                    //SI ESTA BLOKEADO

            $articulos=Article::where('titulo','like',"%$busqueda%")->with(['images'])->orderBy('id','desc')->get();//ArticulosActivos esto es un queryscope esta en el modelo Article se coloca sin scope YA NO HACE FALTA INVOCARLO.. with(['images'] esto llama a images() de Article.. lo puedo poner con () o sin  y como es una session lo muestra una sola vez en articulos.blade.php
            		return view('buscador')->with(compact('articulos'));//va a la vista buscador llevando la variable articulos
               //compact Crear un array que contiene variables y sus valores
             //with es una session q solo se muestra una vez
                }

                //TODO BIEN PASA ACA
                $articulos=Article::where('titulo','like',"%$busqueda%")->with(['images'])->orderBy('id','desc')->get();
                //hago un filtro
                foreach($articulos as $articulo)
                {
                    if(!$articulo->theme->suscripcion) //si el articulo q tiene relacion con thema y esta el campo suscripcion no esta suscripto o sea tiene un 0
                        $articulosPermitidos->push($articulo); //metete en esta coleccion con push es para meter en las colecciones
                }
                return view('buscador')->with(compact('articulosPermitidos'));//y me va DIRIGIR A LA VISTA mostrando TODOS LOS ARTICULOS menos los q no estan suscriptos o sea la tabla Articles theme_id esta relacionado con tabla themes y ahi dice el campo suscripcion (voy a poder bucar los articulos de los themas de los usuarios q tienen subscripcion 0)

            }

//SI email_verified_at ES NULL
             $articulos=Article::where('titulo','like',"%$busqueda%")->with(['images'])->orderBy('id','desc')->get();
             //hago un filtro
             foreach($articulos as $articulo)
             {
                 if(!$articulo->theme->suscripcion) //si el articulo q tiene relacion con thema y esta el campo suscripcion no esta suscripto o sea tiene un 0
                     $articulosPermitidos->push($articulo); //metete en esta coleccion con push es para meter en las colecciones
             }
             return view('buscador')->with(compact('articulosPermitidos'));//y me va DIRIGIR A LA VISTA mostrando TODOS LOS ARTICULOS menos los q no estan suscriptos o sea la tabla Articles theme_id esta relacionado con tabla themes y ahi dice el campo suscripcion (voy a poder bucar los articulos de los themas de los usuarios q tienen subscripcion 0)


        }
        //SI no estoy autenticado paso por aca

                $articulos=Article::where('titulo','like',"%$busqueda%")->with(['images'])->orderBy('id','desc')->get();
                //hago un filtro
                foreach($articulos as $articulo)
                {
                    if(!$articulo->theme->suscripcion) //si el articulo q tiene relacion con thema y esta el campo suscripcion no esta suscripto o sea tiene un 0
                        $articulosPermitidos->push($articulo); //metete en esta coleccion con push es para meter en las colecciones
                }
                return view('buscador')->with(compact('articulosPermitidos'));//y me va DIRIGIR A LA VISTA mostrando TODOS LOS ARTICULOS menos los q no estan suscriptos o sea la tabla Articles theme_id esta relacionado con tabla themes y ahi dice el campo suscripcion (voy a poder bucar los articulos de los themas de los usuarios q tienen subscripcion 0)

    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
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

    public function buscadorPredictivo()
    {   
        $articulos=Article::pluck('titulo');
        return $articulos;
    }
}
