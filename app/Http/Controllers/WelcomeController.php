<?php

namespace App\Http\Controllers;
use App\Theme;
use App\SliderImage;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB; //SE USA PARA METODO SQL PURO O PARA QUERY BUILDER
//use App\Theme;//llamo al modelo

class WelcomeController extends Controller
{
   public function welcome(){
//se puede usar sql puro
     // $temasTodos = DB::select('select * from themes');
     //TAMBIEN query builder
      // $temasTodos = DB::table('themes')->get();//LLAMA AL CONTROLADOR Y LA ACCION
      //Y LA MAGIA DE eloquent
      //$temasTodos=Theme::all();//ACA UTILIZA EL MODELO
      //return dd($temasTodos);//esto es como un var_dump
      $temasDestacados=Theme::where('destacado',1)->with(['articles.images'])->orderby('id','asc')->get();//con Theme::where('destacado',1) preguntamos los temas q tengan destacado en 1 Y articles.images seria llamo a los articulos y tambien llamo a images no hace falta () auqe va tambien con los parentesis TODO GRACIAS A OMR ELOQUENT :)

      //$temasDestacados=Theme::where('destacado',1)->orderby('id','desc')->get();//con Theme::where('destacado',1) preguntamos los temas q tengan destacado en 1
      $imagenes=SliderImage::all();//para tener todo de las imagenes de los slider
      return view('welcome')->with(compact('temasDestacados','imagenes'));//me muestra la viste welcome llevando la coleccion temasDestacados.. compact esto es para pasarle las variables a las vistas de una forma sensilla es propio de laravel


    //return view('welcome');
   }

   public function sobremi(){

      return view('admin.usuarios.sobremi');
   }

   public function contacto(){

      return view('admin.usuarios.contacto');
   }
}
