<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Producto;
use App\Resena;
use App\Cancelacion;
use App\Carrito;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Direccion;
use Carbon\Carbon;
use auth;
use App\Venta;
use Culqi;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $usuario = User::findOrFail(auth()->user()->id);

        return view('perfil.cuenta',compact('usuario'));
    }

    public function editar_perfil(Request $request){

        
        $validator = $request->validate([
            'name'=>'required|min:3| max: 50',
            'fullname'=>'required|min:3| max: 80',
            'password'=>'min:6|max:30|confirmed',
            'telefono'=>'required|min:3| max: 15',
            'tipo_doc'=>'required|min:3| max: 50',
            'num_doc'=>'required|min:3| max: 20',
        ]);

        try {
            
    
            $user = User::findOrFail(auth()->user()->id);
            $user->name = $request->get('name');
            $user->fullname = $request->get('fullname');
            $user->telefono = $request->get('telefono');
            $user->tipo_doc = $request->get('tipo_doc');
            $user->num_doc = $request->get('num_doc');
            if($request->get('contrasena')){
                $user->password = bcrypt($request->get('contrasena'));
            }
            $user->update();

            Session::flash('success', 'Se actualizó sus datos de su perfíl');
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al completar el formulario');
            return redirect()->back();
        }

    }

    public function direccion(){

        $paises = json_decode(file_get_contents('https://restcountries.eu/rest/v2/all',true));

        $direcciones = DB::table('direccion')
        ->where('iduser','=',auth()->user()->id)
        ->orderby('id','desc')
        ->get();

        return view('perfil.direccion',compact('paises','direcciones'));
    }

    public function direccion_registro(Request $request){
        $validator = $request->validate([
            'direccion'=>'required|min:3| max: 400',
            'pais'=>'required|min:3| max: 100',
            'region'=>'required|min:3| max: 100',
            'ciudad'=>'required|min:3| max: 100',
            'zip'=>'required|min:2| max: 15',
        ]);

        try {
            $direccion = new Direccion;
            $direccion->direccion = $request->get('direccion');
            $direccion->pais = $request->get('pais');
            $direccion->region = $request->get('region');
            $direccion->ciudad = $request->get('ciudad');
            $direccion->zip = $request->get('zip');
            $direccion->iduser = auth()->user()->id;
            $direccion->save();
            
            Session::flash('success', 'Se registro una nueva dirección en su cuenta.');
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al completar el formulario.');
            return redirect()->back();
        }
    }

    public function direccion_eliminar($id){
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();

        Session::flash('success', 'Se eliminó la dirección correctamente');
        return redirect()->back();
    }

    public function agregar_carrito(Request $request){

        $validator = $request->validate([
            'idproducto'=>'required|numeric',
            'cantidad'=>'required|numeric',
        ]);

        try {
            $producto = Producto::findOrFail($request->get('idproducto'));
            $stock_actual = $producto->{'stock'};

            if($request->get('cantidad') > $stock_actual){
                Session::flash('danger', 'No puede superar el stock actual.');
                return redirect()->back();
            }
            else{
                $carrito = new Carrito;
                $carrito->idproducto = $request->get('idproducto'); 
                $carrito->cantidad = $request->get('cantidad'); 
                $carrito->iduser = auth()->user()->id;
                $mytime = Carbon::now('America/Lima');
                $carrito->createAt=$mytime->toDateTimeString();
                $carrito->save();

                Session::flash('success', 'El producto se agregó al carrito.');
                return redirect()->back();
            }

           

        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al agregarlo al carrito.');
            return redirect()->back();
        }
    }

    public function quitar_del_carrito($id){
        $carrito = Carrito::findOrFail($id);
        $carrito->delete();
        return redirect()->back();
    }

    public function carrito(){

        $total = 0;

        $config = DB::table('configuraciones')
        ->first();

        $carrito = DB::table('carrito as c')
        ->join('producto as p','c.idproducto','=','p.id')
        ->select('c.cantidad','p.poster','p.titulo','p.precio_ahora','c.id','p.slug','c.idproducto')
        ->where('iduser','=',auth()->user()->id)
        ->orderby('id','desc')
        ->paginate(10);

        foreach($carrito as $item){
            $subtotal = $item->precio_ahora * $item->cantidad;
            $total = $total + $subtotal;
        }

        $direcciones = DB::table('direccion')
        ->where('iduser','=',auth()->user()->id)
        ->orderby('id','desc')
        ->get();

        $productos = [];
        $cantidades = [];

        foreach($carrito as $item){
            array_push($productos,$item->idproducto);
            array_push($cantidades,$item->cantidad);
        }

        $data_productos = implode('-',$productos);
        $data_cantidades = implode('-',$cantidades);

        $authenticate = auth::check();

        return view('perfil.carrito',compact('carrito','direcciones','total','authenticate','data_productos','data_cantidades','config'));
    }

    public function checkout($codigo,$transaccion,$productos,$cantidades,$direccion,$total,$currency,$metodo){
        $productos = explode("-",$productos);
        $cantidades = explode("-",$cantidades);

        $config = DB::table('configuraciones')
        ->first();
        if($metodo == 'culqi'){
            try {
                $SECRET_KEY = $config->{'culqui_key_private'};
                $culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));
                
                $charge = $culqi->Charges->create(
                    array(
                    "amount" => $total,
                    "capture" => true,
                    "currency_code" => $currency,
                    "description" => $config->{'titulo'},
                    "email" => "test@culqi.com",
                    "source_id" => $transaccion
                    )
                );
            }catch(\Exception $e){
                dd($e);
                Session::flash('danger', 'Se rechazó la tarjera de crédito, intente con otra.');
                return Redirect::back();
            }
        }   

        try { 

            $cont = 0;


            $carrito = DB::table('carrito')
            ->where('iduser','=',auth()->user()->id)
            ->get();

            while($cont<count($productos)){

                $producto = Producto::findOrFail($productos[$cont]);

                $venta = new Venta;
                $venta->idproducto = $productos[$cont];
                $venta->cantidad = $cantidades[$cont];
                $venta->iddireccion = $direccion;
                $venta->iduser = auth()->user()->id;
                $venta->transaccion = $transaccion;
                $venta->codigo = uniqid();
                $venta->total = $producto->precio_ahora * $cantidades[$cont];
                $mytime = Carbon::now('America/Lima');
                $venta->createAt = $mytime->toDateTimeString();
                $venta->estado = 'Procesando';
                if($metodo == 'culqi'){
                    $venta->metodo = 'Tarjeta de Crédito';
                }else if($metodo == 'paypal'){
                    $venta->metodo = 'Paypal';
                }
                $venta->save();

                $producto_stock = Producto::findOrFail($productos[$cont]);
                $producto_stock->stock = $producto_stock->stock - $cantidades[$cont];
                $producto_stock->num_ventas = $producto_stock->num_ventas + $cantidades[$cont];
                $producto_stock->update();


                $carrito_del = Carrito::findOrFail($carrito[$cont]->id);
                $carrito_del->delete();

                $cont = $cont+1;
                
            }

            Session::flash('success', 'Se procesó la compra correctamente.');
            return redirect()->route('mis_compras');
        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Ocurrió un error al procesar el pago, vuelva a intentar.');
            return redirect()->back();//throw $th;
        }
    }

    public function mis_compras(){

        $ventas = DB::table('venta as v')
        ->join('producto as p','v.idproducto','=','p.id')
        ->join('direccion as d','v.iddireccion','=','d.id')
        ->select('p.poster','p.titulo','v.total','v.cantidad','v.estado','v.createAt','v.codigo','v.id','p.slug')
        ->where('v.iduser','=',auth()->user()->id)
        ->orderby('v.id','desc')
        ->paginate(15);

        return view('perfil.mis_compras',compact('ventas'));
    }

    public function detalle_compra($codigo){
        $venta = DB::table('venta as v')
        ->join('producto as p','v.idproducto','=','p.id')
        ->join('direccion as d','v.iddireccion','=','d.id')
        ->select('p.poster','p.titulo','v.total','v.cantidad','v.estado','v.createAt','v.codigo','d.direccion','d.pais','d.region','d.ciudad','d.zip','v.tiempo','v.track','v.medio_postal','v.metodo','p.poster','p.slug','v.id','p.id as idproducto')
        ->where('codigo','=',$codigo)
        ->first();

        $resena = DB::table('resena')
        ->where([
            ['idproducto','=',$venta->{'idproducto'}],
            ['iduser','=',auth()->user()->id]
        ])
        ->first();



        return view('perfil.detalle_compra',compact('venta','resena'));
    }

    public function confirmar_entraga($id){

        $venta = Venta::findOrFail($id);
        $venta->estado = 'Entregado';
        $venta->update();

        Session::flash('success', 'Se confirmó la entrega de su paquete.');
        return redirect()->back();
    }

    public function emitir_resena(Request $request){
        try {
            $validator = $request->validate([
                'resena'=>'required|max:500',
                'idproducto'=>'required',
                'foto_uno'=>'required|max:5000',
                'foto_dos'=>'required|max:5000',
                'foto_tres'=>'required|max:5000',
            ]);

            $resena = new Resena;
            $resena->resena = $request->get('resena');
            $resena->iduser = auth()->user()->id;
            $resena->idproducto = $request->get('idproducto');
            $mytime = Carbon::now('America/Lima');
            $resena->createAt = $mytime->toDateTimeString();

            $imageName1 = uniqid().rand().'.'.$request->foto_uno->extension();  
            $request->foto_uno->move(public_path('resenas'), $imageName1);
            $resena->foto_uno = $imageName1;

            $imageName2 = uniqid().rand().'.'.$request->foto_dos->extension();  
            $request->foto_dos->move(public_path('resenas'), $imageName2);
            $resena->foto_dos = $imageName2;

            $imageName3 = uniqid().rand().'.'.$request->foto_tres->extension();  
            $request->foto_tres->move(public_path('resenas'), $imageName3);
            $resena->foto_tres = $imageName3;
            $resena->save();

            Session::flash('success', 'Se envió su resena, feliciades.');
            return redirect()->back();
        } catch (\Exception $e) {
            
            Session::flash('danger', 'Ocurrió un error al enviar la resena, vuelva a intentar.');
            return redirect()->back();//throw $th;
        }
    }

    public function cancelacion(Request $request){
        try {
            $validator = $request->validate([
                'motivo'=>'required|max:500',
                'idventa'=>'required',
            ]);

            $cancelacion = new Cancelacion;
            $cancelacion->motivo=$request->get('motivo');
            $cancelacion->idventa=$request->get('idventa');
            $cancelacion->estado= 'Pendiente';
            $mytime = Carbon::now('America/Lima');
            $cancelacion->fecha = $mytime->toDateTimeString();
            $cancelacion->save();

            $venta = Venta::findOrFail($request->get('idventa'));
            $venta->estado='Cancelado';
            $venta->update();

            Session::flash('success', 'Se envio la solicitud de cancelación.');
            return redirect()->back()->withErrors($validator)->withInput();

        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al completar el formulario.');
            return redirect()->back();//throw $th;
        }
    }
}
