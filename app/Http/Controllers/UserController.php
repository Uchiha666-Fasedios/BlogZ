<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;//importo para q ande lo de rule
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //POR SEGURIDAD PONGO ESTE MIDDLEWARE HACE Q SOLO ESTOS METODOS LOS PUEDAN USAR LOS USUARIOS AUTENTICADO
    }


    public function index()
    {
        //
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


    public function update(Request $request)
    {


        $usuario=auth()->user();

        $messages=[
            'nombre.required' => 'Campo nombre requerido',
            'nombre.max' => 'Campo nombre demasiado largo',

            'alias.required' => 'Campo alias requerido',
            'alias.min' => 'Campo alias demasiado corto',
            'alias.max' => 'Campo alias demasiado largo',
            'alias.unique' => 'El alias ya existe en nuestra base de datos',

            'web.max' => 'Campo web demasiado largo',

            'password.required' => 'Campo password requerido',
            'password.regex' => 'La contraseña debe tener un minimo de 8 caracter y contener al menos una mayuscula, una minuscula y un número o caracter especial.'
        ];

        $rules=[
            'nombre' => 'required|string|max:190',
            /*'alias' => 'required|string|min:3|max:20|unique:users',*/
            'alias' => ['required','string','min:3','max:10',Rule::unique('users')->ignore($usuario->id)], //Rule::unique('users')->ignore($usuario->id) ACA LE DIGO Q me ignore el alias de mi mismo o sea q no me diga q esta repetido el alias mio mismo
            'web' => 'max:20',
            'password' => array('required','string','regex:/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/')
        ];

        $this->validate($request, $rules, $messages);//CON ESTO LE DIGO VALIDAMELO Y SI TODO ESTA OK PASO ABAJO

        $usuario=auth()->user();
        //return dd($usuario); esto es un var_dump
        $usuario->name=$request->nombre; //$usuario->name este campo refiere al de la tabla users y $request->nombre refiere a el nombre del input
        $usuario->alias=$request->alias;
        $usuario->web=$request->web;
        $usuario->password=bcrypt($request->password);
        $usuario->update();
        $notificacion="Sus datos se han actualizado correctamente";
    return back()->with(compact('notificacion'));//back() nos redirige atras ..notificacion le paso esta variable
    //return back();//nos redirige atras
    }


    public function destroy($id)
    {
        //
    }
}
