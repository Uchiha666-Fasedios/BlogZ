<?php

namespace App\Http\Controllers\moderador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ArticleImage;//importo el modelo tipo imagen
use Illuminate\Support\Facades\Storage;//importo esto para q ande storage

class ArticleImageController extends Controller
{
    public function destroy(ArticleImage $imagen)
{
    $this->authorize('delete',$imagen); //ESTO ES LA POLITICA HECHA EN App/Policies/ArticleImagePolicy.php ..delete HACE REFERENCIA A EL METODO Q ESTA AHI Y imagen BUE al imagen q estoy pasando
    //Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
    Storage::disk('imagenesArticulos')->delete($imagen->nombre);//la borramos fisicamente de la carpeta
    //$imagen->forceDelete();//la borramos de la tabla
    $imagen->delete();//la borramos de la tabla
    $notificacion="Imágen eliminada correctamente correctamente";
    return back()->with(compact('notificacion'));//back va para atras
}

}


