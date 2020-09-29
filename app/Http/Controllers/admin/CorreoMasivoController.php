<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
//use Mail;//se debe importar esto para q funcione esto del email esto es propio de laravel
use App\Mail\CorreoMasivo;//importo esta clase q he creado
use Illuminate\Support\Facades\Mail;//se debe importar esto para q funcione esto del email esto es propio de laravel

class CorreoMasivoController extends Controller
{
    public function index()
    {
    	$miga='Enviar Correos';
        return view('admin.correo-masivo')->with(compact('miga'));
    }

    public function correoMasivo(Request $request)
    {

        $messages=[
            'titulo.required'=>'El campo Asunto no puede quedar vacio',
            'contenido.required'=>'El campo Contenido no puede quedar vacio',
        ];
        $rules=[
            'titulo'=>'required',
            'contenido'=>'required',
        ];
        $this->validate($request, $rules, $messages);
        $asunto=$request->titulo;
        $contenido=$request->contenido;
        $usuarios=User::where('bloqueado',false)->whereNotNull('email_verified_at')->get();//where('bloqueado',false) los usuarios q no esten bloqueados.. ->whereNotNull('email_verified_at') los q no tengan este campo en null
        foreach ($usuarios as $usuario) {
        	// aquí vamos enviando los correos a cada usuario.
        	Mail::to($usuario)->send(new CorreoMasivo($usuario , $asunto , $contenido));//to($usuario) pra quien es el correo pues para este usuario ..le manda el mail instanciando el modelo o clase q se hizo CorreoMasivo.. send() significa enviar
        	//Mail::to($usuario)->queue(new CorreoMasivo($usuario , $asunto , $contenido));//to($usuario) pra quien es el correo pues para este usuario ..le manda el mail instanciando el modelo o clase q se hizo CorreoMasivo.. send() significa enviar queue() es para encolar los mail pero se usa con esto de los mail por la libreria y todo lo q hicimos
        }

        $notificacion="Se ha enviado correctamente el mensaje a todos los subscriptores";
        return back()->with(compact('notificacion'));
    }
}
