<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;

class CategoriaController extends Controller
{
    function store(Request $request){
        $validator = $request->validate([
            'titulo'=>'required|max:250|unique:producto', 
        ]);

        $categoria = new Categoria;
        $categoria->titulo = $request->get('titulo');
        $categoria->icono = $request->get('icono');
        $categoria->save();

        Session::flash('succes', 'Se registró su categoria con exito');
        return Redirect::to('admin/productos');

    }

}
