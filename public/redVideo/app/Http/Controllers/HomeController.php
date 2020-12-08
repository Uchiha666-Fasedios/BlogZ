<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;//para poder tener el modelo Image
use App\Video;//para poder tener el modelo Image

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//este middleware hace q el resto de metodos sean privados y va requerir autenticacion en todo momento
        //o sea con esto voy a blokear todos los metodos ecepto cuando este idintificado
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    //  $images=Image::orderBy('id','desc')->get();//no hago una instancia porqe con gracias a el ORM del modelo Image no es necesario orderBy echa por laravel get() para q me muestre los datos
      //$images=Image::all();//lo mismo pero no me lo ordenaria como yo quiero
      $images=Image::orderBy('id','desc')->paginate(5);//PGINACION MAGICA CON LARAVEL
      $videos=Video::orderBy('id','desc')->paginate(5);//PGINACION MAGICA CON LARAVEL
        return view('home',[
          'images'=>$images,
          'videos'=>$videos
        ]);
    }


    //ESTA FUNCION ES PARA EL VIDEO YOUTUBE
    function videoyou(){
    $embedCode = '<iframe width="560" height="315" src="https://www.youtube.com/embed/dwJasig9Olw" frameborder="0" allowfullscreen></iframe>';
      preg_match('/src="([^"]+)"/', $embedCode, $match);
      
      // Extract video url from embed code
      $videoURL = $match[1];
      $urlArr = explode("/",$videoURL);
      $urlArrNum = count($urlArr);
      
      // YouTube video ID
      $youtubeVideoId = $urlArr[$urlArrNum - 1];
      
      // Generate youtube thumbnail url
      $thumbURL = 'http://img.youtube.com/vi/'.$youtubeVideoId.'/0.jpg';
      
      // Display thumbnail image
      echo '<img src="'.$thumbURL.'"/>';


      // YouTube video url
$videoURL = 'https://youtu.be/dwJasig9Olw';
$urlArr = explode("/",$videoURL);
$urlArrNum = count($urlArr);

// Youtube video ID
$youtubeVideoId = $urlArr[$urlArrNum - 1];

// Generate youtube thumbnail url
$thumbURL = 'http://img.youtube.com/vi/'.$youtubeVideoId.'/0.jpg';

// Display thumbnail image
echo '<img src="'.$thumbURL.'"/>';
    }


   




}
