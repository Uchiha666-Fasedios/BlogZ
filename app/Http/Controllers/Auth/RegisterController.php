<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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

    use RegistersUsers; //aca esta el metodo q muestra la vista del registro y la ruta esta en vendor se tuvo q tocar para pasarle la variable con los themas pero despues se paso la variable de otra manera mejor..

    //ESTA FUNCION LA SAQE DE RegistersUsers Q ESTA EN EL VENDOR Y LE PUSE LOGICA
    protected function registered(Request $request, $user)
    {
        $user->roles()->sync(1);//borra todos los roles de ese usuario y le agrega estE Q ES EL DE USUARIO O SEA SE VAN A REGISTRAR COMO USUARIO
        return redirect($this->redirectPath());//ME REDIRIGE A LA VISTA HOME ESTA HECHO POR LARAVEL
    }

    protected $redirectTo = RouteServiceProvider::HOME;


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


    public function comprobarAlias($alias = null)//lo dejo nulo por defecto porqe puede ser nulo cuando deja vacio el input
    {
        $alias=User::where('alias',$alias)->first();//si ay alguno en la tabla con ese alias cogelo
        if($alias)
            return json_encode(true);//retorna true
        return json_encode(false);
    }

    protected function validator(array $data)
    {
        /* mio */
        $mensajes = array(
            'name.required' => 'Campo nombre requerido',
            'name.max' => 'Campo nombre demasiado largo',

            'email.required' => 'Campo email requerido',
            'email.max' => 'Campo email demasiado largo',
            'email.unique' => 'El email ya existe en nuestra base de datos',
            'email.email' => 'El email debe ser un email válido',

            'alias.required' => 'Campo alias requerido',
            'alias.min' => 'Campo alias demasiado corto',
            'alias.max' => 'Campo alias demasiado largo',
            'alias.unique' => 'El alias ya existe en nuestra base de datos',

            'web.max' => 'Campo web demasiado largo',

            'password.required' => 'Campo password requerido',
            'password.confirmed' => 'Los Campos password no coinciden',
            'password.regex' => 'La contraseña debe tener un minimo de 8 caracter y contener al menos una mayuscula, una minuscula y un número o caracter especial.'

        );
        /* mio */
//este return es lo q trae laravel por defecto
        return Validator::make($data, [
            'name' => 'required|string|max:190',
            'email' => 'required|string|email|max:190|unique:users',
            /* mio */
            'alias' => 'required|string|min:3|max:20|unique:users',
            'web' => 'max:30',
            /* mio */
            'password' => 'required|string|min:8|confirmed',
            'password' => array('required','string','confirmed','regex:/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/')
        ],$mensajes);//,$mensajes trae los mensajes personalizados para q tengan efecto
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            /* mio */
            'alias' => $data['alias'],
            'web' => $data['web'],
            /* mio */
            'password' => Hash::make($data['password']),
        ]);
    }
}
