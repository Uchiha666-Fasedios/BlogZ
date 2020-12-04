<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';//cuando me registro me redirige ..le saque el home para q me redireccione a el login

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     //ACA VAN LOS CAMPOS DE REGISTRO PARA VALIDARLOS
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',//max:255 de maximo
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)//ESTE SE INVOCA DESDE EL FORMULARIO Q ME TRAE LOS POST
    {
        return User::create([
            'role' => 'user',//en este caso el role lo pongo fijo
            'name' => $data['name'],
            'surname' => $data['surname'],
            'nick' => $data['nick'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
