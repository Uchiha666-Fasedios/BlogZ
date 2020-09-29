<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuraciones;
use DB;
use Session;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    function config(){

        $config = DB::table('configuraciones')
        ->first();

        return view('admin.configuraciones.index',compact('config'));
    }

    function config_save(Request $request){

        $validator = $request->validate([
            'titulo'=>'required|max:150',
            'correo'=>'required|max:150',
            'telefono'=>'required|max:20',
            'correo'=>'required|max:100',
            'direccion'=>'required|max:300',
            'horario'=>'required|max:200',
            'facebook'=>'required|max:200',
            'twitter'=>'required|max:200',
            'msm_procesado'=>'required|max:500',
            'msm_cancelado'=>'required|max:500',
            'msm_entregado'=>'required|max:500',
            'logo'=>'max:3000',
            'banner_inicio_uno'=>'max:5000',
            'banner_inicio_dos'=>'max:5000',
            'banner_producto'=>'max:5000',
            'paypal_mode'=>'required|max:20',
            'paypal_client_id'=>'required|max:250',
            'tipo_moneda'=>'required|max:20',
        ]);

        try {
            
            
            $config = Configuraciones::findOrFail(1);
            $config->titulo = $request->get('titulo');
            $config->correo = $request->get('correo');
            $config->telefono = $request->get('telefono');
            $config->direccion = $request->get('direccion');
            $config->horario = $request->get('horario');
            $config->facebook = $request->get('facebook');
            $config->twitter = $request->get('twitter');

            if($request->logo){
                $imageName1 = uniqid().'.'.$request->logo->extension();  
                $request->logo->move(public_path('config'), $imageName1);
                $config->logo = $imageName1;
            }

            if($request->banner_inicio_uno){
                $imageName2 = uniqid().'.'.$request->banner_inicio_uno->extension();  
                $request->banner_inicio_uno->move(public_path('config'), $imageName2);
                $config->banner_inicio_uno = $imageName2;
            }

            if($request->banner_inicio_dos){
                $imageName3 = uniqid().'.'.$request->banner_inicio_dos->extension();  
                $request->banner_inicio_dos->move(public_path('config'), $imageName3);
                $config->banner_inicio_dos = $imageName3;
            }

            if($request->banner_producto){
                $imageName4 = uniqid().'.'.$request->banner_producto->extension();  
                $request->banner_producto->move(public_path('config'), $imageName4);
                $config->banner_producto = $imageName4;
            }

            $config->msm_procesado = $request->get('msm_procesado');
            $config->msm_cancelado = $request->get('msm_cancelado');
            $config->msm_entregado = $request->get('msm_entregado');
            $config->paypal_mode = $request->get('paypal_mode');
            $config->paypal_client_id = $request->get('paypal_client_id');
            $config->tipo_moneda = $request->get('tipo_moneda');
            $config->paypal_client_id_production = $request->get('paypal_client_id_production');
            $config->culqui_key_public = $request->get('culqui_key_public');
            $config->culqui_key_private = $request->get('culqui_key_private');
            $config->update();

            Session::flash('success', 'Se actualizó la configuración de su tienda');
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }
}
