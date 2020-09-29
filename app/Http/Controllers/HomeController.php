<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Theme;//llamo al modelo


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//este middleware lo q hace es q todos estos metodos de esta clase solo lo van a usar los autentificados
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //$temasTodos=Theme::all();//ACA UTILIZA EL MODELO
        return view('home');//le paso la variable a la vista welcome
        //return view('home');
    }
}
