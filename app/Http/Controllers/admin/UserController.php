<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miga='Usuarios';
       // $usuarios=User::with('roles')->orderBy('id','desc')->paginate(10);//with('roles') invoco del modelo User el metodo roles para q me traiga los roles asi no gasto recursos en la vista y asi voy convirtiendo a $usuarios en una coleccion
        $usuarios=User::with('roles')->whereNotNull('email_verified_at')->orderBy('id','desc')->paginate(10);//with('roles') invoco del modelo User el metodo roles para q me traiga los roles asi no gasto recursos en la vista y asi voy convirtiendo a $usuarios en una coleccion.. whereNotNull('email_verified_at') los usuarios q no tengan este campo en null
        return view("admin.usuarios.index")->with(compact('miga','usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $miga='Editar Usuario';
        return view('admin.usuarios.edit')->with(compact('usuario','miga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $moderador=$request->moderador;//gardo lo q me llega del input
        if($moderador){//si es true o sea si es 1 es q del radio eligi moderador entro al if
            $usuario->roles()->sync([1,2]);//pongo los roles de este usuario como usuario y moderador o sea 1 y 2
        }

        else{
            $usuario->roles()->sync(1);//lo pongo como usuario o sea 1
        }
        $usuario->bloqueado=$request->bloqueado;//guardo lo q me llega del input
        $usuario->save();
        $notificacion="El usuario se ha actualizado";
        return redirect('admin/usuarios')->with(compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
