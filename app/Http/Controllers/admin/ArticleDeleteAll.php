<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Article;

class ArticleDeleteAll extends Controller
{
    public function eliminarTodosArticulos()
    {
        $articulos=Article::withoutGlobalScope('activo')->get();//agarro todos los articulos activos
        foreach($articulos as $articulo)
        {
            foreach($articulo->images as $imagen)
            {
                // lo borramos físicamente
                Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);//borro las imagenes de la carpeta
            }
            $articulo->delete();//elimino los articulos logicamente
            //$articulo->forceDelete();//elimino los articulos permanentemente
        }
    }
}
