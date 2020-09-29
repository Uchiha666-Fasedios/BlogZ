<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\User;
use App\Contacto;
use App\Producto;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;

class InicioController extends Controller
{
    public function index(){
        try {
            $best = DB::table('producto as p')
            ->orderby('num_ventas','desc')
            ->take(3)
            ->get();

            $newest = DB::table('producto')
            ->orderby('id','desc')
            ->take(4)
            ->get();

            $hot = DB::table('producto')
            ->orderby('precio_ahora','asc')
            ->take(3)
            ->get();

            $mejor = DB::table('producto')
            ->orderby('precio_ahora','desc')
            ->take(3)
            ->get();

            $reco = DB::table('producto')
            ->orderby('titulo','asc')
            ->take(3)
            ->get();

            $config = DB::table('configuraciones')
            ->first();

        } catch (\Exception $e) {
            //throw $th;
        }


        return view('inicio',compact('best','newest','hot','mejor','reco','config'));
    }

    public function sesion_usuario(){
   
        if (auth::check()) {
            return redirect()->to('dashboard');
        }else{
            return view('auth.loginuser');
        }
    }

    public function registro_rapido(Request $request){
        $validator = $request->validate([
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:30',
        ]);

        
        $user = new User;
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->role = 'USER';
        $user->save();

        Session::flash('success', 'Ustéd se registro correctamente, ya puede iniciar sesión.');
        return redirect('sesion');

    }

    public function productos(Request $request){

        $categorias = DB::table('categoria')
        ->orderby('titulo','asc')
        ->get();

        

        if($request){
            $pmajor=$request->get('pmajor');
            $pminor=$request->get('pminor');
            $buscar=$request->get('buscar');
            $marca=$request->get('marca');
            

            if($pmajor != '' && $pminor != ''){
                $buscar=$request->get('buscar');
                $productos = DB::table('producto')
                ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                ->where([
                    ['titulo','LIKE','%'.$buscar.'%'],
                ])
                ->orderby('id','desc')
                ->paginate(15);
                
            }
            else if($marca != ''){
                $buscar=$request->get('buscar');
                $productos = DB::table('producto')
                ->where([
                    ['titulo','LIKE','%'.$marca.'%']  
                ])
                ->orderby('id','desc')
                ->paginate(15);
            }
            else{
                $pminor = 0;
                $pmajor = 3000;
                $marca='';
                $productos = DB::table('producto')
                ->where([
                    ['titulo','LIKE','%'.$buscar.'%'],
                    ['titulo','LIKE','%'.$marca.'%']  
                ])
                ->orderby('id','desc')
                ->paginate(15);
                
            }
            try {
                $features = DB::table('producto')
                ->get()
                ->random(3);
            } catch (\Throwable $th) {
                return view('productos',compact('categorias','productos','buscar','pminor','pmajor'));
            }

            return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
        }

        
    }

    public function productos_by_cat($categoria){

        $categorias = DB::table('categoria')
        ->orderby('titulo','asc')
        ->get();

        $cat = DB::table('categoria')
        ->where('titulo','=',$categoria)
        ->first();

        $pminor = 0;
        $pmajor = 3000;

        $productos = DB::table('producto')
        ->where([
            ['idcategoria','=',$cat->id],
        ])
        ->orderby('id','desc')
        ->paginate(15);

        try {
            $features = DB::table('producto')
            ->get()
            ->random(3);
        } catch (\Throwable $th) {
            return view('productos',compact('categorias','productos','pminor','pmajor'));
        }


        return view('productos',compact('categorias','productos','pminor','pmajor','features'));
    }

    public function producto_detalle($slug){

        $producto = Producto::where('slug','=',$slug)->firstOrFail();

        $galeria = DB::table('galeria')
        ->where('idproducto','=',$producto->id)
        ->get();

        $resenas = DB::table('resena as r')
        ->join('users as u','r.iduser','=','u.id')
        ->where('idproducto','=',$producto->id)
        ->get();

    
        try {
            $features = DB::table('producto')
            ->get()
            ->random(3);
        } catch (\Throwable $th) {
            return view('detalle_producto',compact('producto','galeria','resenas'));
        }

        return view('detalle_producto',compact('producto','galeria','resenas','features'));
    }
    
    public function contacto(){
        return view('contacto');
    }

    public function contacto_send(Request $request){

        $validator = $request->validate([
            'nombres'=>'required|max:250',
            'correo'=>'required|email|max:100',
            'telefono'=>'required|max:15',
            'mensaje'=>'required',
        ]);

        try {
            $contacto = new Contacto;
            $contacto->nombres=$request->get('nombres');
            $contacto->correo=$request->get('correo');
            $contacto->telefono=$request->get('telefono');
            $contacto->mensaje=$request->get('mensaje');
            $contacto->save();

            Session::flash('success', 'Su mensaje se envió a soporte, resivirá un mensaje en su bandeja.');
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al completar el formulario.');
            return redirect()->back();
        }
    }

    public function best_seller(){

        $productos = DB::table('producto as p')
        ->join('categoria as c','p.idcategoria','=','c.id')
        ->select('p.poster','c.titulo as categoria','p.titulo','p.slug','p.precio_ahora','p.id','p.precio_antes')
        ->orderby('num_ventas','desc')
        ->take(16)
        ->get();

        return view('best-seller',compact('productos'));
    }
}
