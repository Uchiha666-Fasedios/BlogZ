<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Venta;
use App\Cancelacion;
use App\Producto;
use Session;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function cancelaciones(Request $request){

        $buscar = $request->get('buscar');

        $cancelaciones = DB::table('cancelacion as c')
        ->join('venta as v','c.idventa','=','v.id')
        ->join('users as u','v.iduser','=','u.id')
        ->join('producto as p','v.idproducto','=','p.id')
        ->select('u.name','u.fullname','c.fecha','c.estado','v.total','c.id','v.metodo','v.codigo','p.titulo as producto')
        ->where('u.name','LIKE','%'.$buscar.'%')
        ->paginate(15);

        return view('admin.ventas.cancelacion',compact('cancelaciones'));
    }

    public function aplicar_reembolso($codigo){
        $venta = Venta::where('codigo','=',$codigo)->firstOrFail();
        $venta->estado = 'Reembolsado';
        $venta->update();

        $producto = Producto::findOrFail($venta->idproducto);
        $producto->stock = $producto->stock + $venta->cantidad;
        $producto->update();

        $cancelacion = Cancelacion::where('idventa','=',$venta->id)->firstOrFail();
        $cancelacion->estado = 'Reembolsado';
        $cancelacion->update();

        Session::flash('success', 'Se aprobó y se emitió el reembolso de la compra');
        return redirect()->back();
        
    }

    public function ventas(Request $request){
        try {
            if($request){
                $buscar = $request->get('buscar');
                $ventas = DB::table('venta as v')
                ->join('producto as p','v.idproducto','=','p.id')
                ->join('direccion as d','v.iddireccion','=','d.id')
                ->join('users as u','v.iduser','=','u.id')
                ->select('p.poster','p.titulo','v.total','v.cantidad','v.estado','v.createAt','v.codigo','v.id','p.slug','v.codigo','u.name','u.fullname','v.createAt as fecha','v.metodo')
                ->where('v.codigo','LIKE','%'.$buscar.'%')
                ->orderby('v.id','desc')
                ->paginate(15);
            }

            return view('admin.ventas.index',compact('ventas'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function detalle_venta($codigo){
        $venta = DB::table('venta as v')
        ->join('producto as p','v.idproducto','=','p.id')
        ->join('categoria as c','p.idcategoria','=','c.id')
        ->join('direccion as d','v.iddireccion','=','d.id')
        ->join('users as u','v.iduser','=','u.id')
        ->select('p.poster','p.titulo','v.total','v.cantidad','v.estado','v.createAt','v.codigo','v.id','p.slug','v.codigo','u.name','u.fullname','v.createAt as fecha','v.metodo','c.titulo as categoria','v.transaccion','u.email','v.track','v.tiempo','v.medio_postal','d.direccion','d.pais','d.region','d.ciudad','d.zip')
        ->where('v.codigo','=',$codigo)
        ->first();

        return view('admin.ventas.detalle',compact('venta'));
    }   

    public function aceptar_envio($id){
        try {
            $venta = Venta::findOrFail($id);
            $venta->estado='Enviado';
            $venta->update();

            Session::flash('success', 'Se actualizó el estado de la venta');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('danger', 'Se produjo un error en el proceso');
            return redirect()->back();
        }
    }

    public function update_datos(Request $request,$id){
        try {
            $validator = $request->validate([
                'tiempo'=>'required|max:50',
                'track'=>'required|max:40',
                'medio_postal'=>'required|max:50',
                
            ]);

            $venta = Venta::findOrFail($id);
            $venta->tiempo=$request->get('tiempo');
            $venta->track=$request->get('track');
            $venta->medio_postal=$request->get('medio_postal');
            $venta->update();

            Session::flash('success', 'Se actualizó los datos de envio de la venta');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('danger', 'Se produjo un error en el proceso');
            return redirect()->back();
        }
    }

    public function mensajes(){

        $mensajes = DB::table('mensajes')
        ->orderBy('id','desc')
        ->paginate(20);

        return view('admin.mensajes',compact('mensajes'));
    }
}
