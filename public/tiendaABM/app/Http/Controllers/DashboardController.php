<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){

        $ventas = DB::table('venta')
        ->where('estado','=','Enviado')
        ->get();

        $v_reembolsado = DB::table('venta')
        ->where('estado','=','Reembolsado')
        ->get();

        $users = DB::table('users')
        ->where('role','=','USER')
        ->get();

        return view('dashboard',compact('ventas','v_reembolsado','users'));
    }
}
