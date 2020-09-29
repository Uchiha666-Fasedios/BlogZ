<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Article;
use App\ArticleImage;

//en este controlador hay muchos metodos q se usan por haber instalado la libreria de borrado logico


class ArticleDeleteController extends Controller
{
    public function index()
    {
        $miga='Artículos Borrados';
        $articulos=Article::withoutGlobalScope('activo')->onlyTrashed()->with(['user','theme'])->orderBy('id','desc')->get();//withoutGlobalScope('activo') q no se tenga en cuenta el global scope with(['user','theme']) me va formando la coleccion para ahorrar recursos en la vista  onlyTrashed() este metodo me da todos los q fueron borrados logicamente
        return view('admin.articulosBorrados.index')->with(compact('miga','articulos'));
    }

    public function show($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);//onlyTrashed() me muestra los borrados logicamente findOrFail recoge el articulo con dicho id
        $imagenes=ArticleImage::where('article_id',$id)->onlyTrashed()->get();//recoge las imagenes de dicho articulo.. hay q hacerlo de esta manera porqe estas imagenes tienen un borrado logico ..o sea con esto ->with(['image'] no me dejaria recogerlas esta vez
        $miga='Mostrar Artículo';
        return view('admin.articulosBorrados.show')->with(compact('miga','articulo','imagenes'));
    }

    public function restaurar($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);//onlyTrashed() me muestra los borrados logicamentefindOrFail recoge el articulo con dicho id
        $articulo->restore();//restaura dicho articulo con dichas imagenes porqe va en cascada
        $notificacion="El articulo se ha restaurado";
        return back()->with(compact('notificacion'));
    }

   	public function destroy($id)//el id es del articulo
    {
        $articulo=Article::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);
        $imagenes=ArticleImage::where('article_id',$id)->onlyTrashed()->get();//las imagenes donde article_id sea = a el $id del articulo q me llega
        foreach($imagenes as $imagen)//me hace el bicle sacando las imagenes de dicho articulo
        {
            // lo borramos físicamente
            Storage::disk('imagenesArticulos')->delete($imagen->nombre);//la borramos fisicamente de la carpeta
        }
        $articulo->forceDelete();//elimina permanentemente
        $notificacion2="El articulo se ha eliminado";
        return back()->with(compact('notificacion2'));
    }
}
