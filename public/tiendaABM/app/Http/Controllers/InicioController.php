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
session_start(); 
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

        if (isset($request->categoriaTitulo)) {
            $_SESSION['idCat']=$request->idCat;
            $_SESSION['categoria']=$request->categoriaTitulo;
        }
        

if (isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor']) &&
 isset($_SESSION['marca']) && isset($_SESSION['color']) && isset($_SESSION['categoria'])) {

    $pmajor=$_SESSION['pricemajor'];
    $pminor=$_SESSION['priceminor'];
    $idCat=$_SESSION['idCat'];
    
    $marca=$_SESSION['marca'];
    $color=$_SESSION['color'];


    $productos = DB::table('producto')
    ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                ->where([
                    ['color','LIKE','%'.$color.'%'], 
                    ['idcategoria','LIKE','%'.$idCat.'%'],
                    ['titulo','LIKE','%'.$marca.'%']
                    
                ])
                ->orderby('id','desc')
                ->paginate(15);
                $features = DB::table('producto')
                ->get()
                ->random(3);

                $categorias = DB::table('categoria')
                ->orderby('titulo','asc')
                ->get();
                return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                

            }else if(isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor']) &&
            isset($_SESSION['marca']) && isset($_SESSION['categoria']) && !isset($_SESSION['color'])){ 


            $pmajor=$_SESSION['pricemajor'];
    $pminor=$_SESSION['priceminor'];
    $idCat=$_SESSION['idCat'];
    $marca=$_SESSION['marca'];
    


    $productos = DB::table('producto')
    ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                ->where([
                    ['idcategoria','LIKE','%'.$idCat.'%'],
                    ['titulo','LIKE','%'.$marca.'%']
                    
                ])
                ->orderby('id','desc')
                ->paginate(15);
                $features = DB::table('producto')
                ->get()
                ->random(3);

                $categorias = DB::table('categoria')
                ->orderby('titulo','asc')
                ->get();
                return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
           
            }else if(isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor']) &&
            isset($_SESSION['color']) && isset($_SESSION['categoria']) && !isset($_SESSION['marca'])){


                $pmajor=$_SESSION['pricemajor'];
                $pminor=$_SESSION['priceminor'];
                $idCat=$_SESSION['idCat'];
                $color=$_SESSION['color'];
                
            
            
                $productos = DB::table('producto')
                ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                            ->where([
                                ['idcategoria','LIKE','%'.$idCat.'%'],
                                ['color','LIKE','%'.$color.'%']
                                
                            ])
                            ->orderby('id','desc')
                            ->paginate(15);
                            $features = DB::table('producto')
                            ->get()
                            ->random(3);
            
                            $categorias = DB::table('categoria')
                            ->orderby('titulo','asc')
                            ->get();
                            return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                            return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));


            }else if(isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor'])
             && isset($_SESSION['categoria']) && !isset($_SESSION['color']) && !isset($_SESSION['marca'])){
            
            
                $idCat=$_SESSION['idCat'];
                $pmajor=$_SESSION['pricemajor'];
                $pminor=$_SESSION['priceminor'];
                
            
                $productos = DB::table('producto')
                ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                ->where([
                    ['idcategoria','LIKE','%'.$idCat.'%']
                    
                    
                ])
                            ->orderby('id','desc')
                            ->paginate(15);
                            $features = DB::table('producto')
                            ->get()
                            ->random(3);
            
                            $categorias = DB::table('categoria')
                            ->orderby('titulo','asc')
                            ->get();
                            return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                            return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));

            }else if (isset($_SESSION['marca']) && isset($_SESSION['color']) && isset($_SESSION['categoria']) 
            && !isset($_SESSION['pricemajor']) && !isset($_SESSION['priceminor'])) {

                $pminor = 0;
                           $pmajor = 3000;
                
                $marca=$_SESSION['marca'];
                $color=$_SESSION['color'];
                $idCat=$_SESSION['idCat'];
            
                $productos = DB::table('producto')
                            ->where([
                                ['color','LIKE','%'.$color.'%'], 
                                ['idcategoria','LIKE','%'.$idCat.'%'],
                                ['titulo','LIKE','%'.$marca.'%']
                                
                            ])
                            ->orderby('id','desc')
                            ->paginate(15);
                            $features = DB::table('producto')
                            ->get()
                            ->random(3);
            
                            $categorias = DB::table('categoria')
                            ->orderby('titulo','asc')
                            ->get();
                            return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                            return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                            
            

            }else if (isset($_SESSION['marca']) && !isset($_SESSION['color']) && !isset($_SESSION['categoria']) 
            && !isset($_SESSION['pricemajor']) && !isset($_SESSION['priceminor'])) {

                $pminor = 0;
                $pmajor = 3000;
     
     $marca=$_SESSION['marca'];
     
 
     $productos = DB::table('producto')
                 ->where([
                     
                     ['titulo','LIKE','%'.$marca.'%']
                     
                 ])
                 ->orderby('id','desc')
                 ->paginate(15);
                 $features = DB::table('producto')
                 ->get()
                 ->random(3);
 
                 $categorias = DB::table('categoria')
                 ->orderby('titulo','asc')
                 ->get();
                 return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                 return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                 
            
            }else if (isset($_SESSION['marca']) && isset($_SESSION['categoria']) && !isset($_SESSION['priceminor'])
            && !isset($_SESSION['pricemajor']) && !isset($_SESSION['color'])){
                $pminor = 0;
                $pmajor = 3000;
     
     $marca=$_SESSION['marca'];
     $idCat=$_SESSION['idCat'];
 
 
     $productos = DB::table('producto')
                 ->where([
                    ['idcategoria','LIKE','%'.$idCat.'%'],
                     ['titulo','LIKE','%'.$marca.'%']
                     
                 ])
                 ->orderby('id','desc')
                 ->paginate(15);
                 $features = DB::table('producto')
                 ->get()
                 ->random(3);
 
                 $categorias = DB::table('categoria')
                 ->orderby('titulo','asc')
                 ->get();
                 return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                 return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                 

            }else if (isset($_SESSION['color']) && !isset($_SESSION['categoria']) && !isset($_SESSION['pricemajor'])
            && !isset($_SESSION['priceminor']) && !isset($_SESSION['marca'])){
                $pminor = 0;
                $pmajor = 3000;
     
     $color=$_SESSION['color'];
     
 
 
     $productos = DB::table('producto')
                 ->where([
                     
                     ['color','LIKE','%'.$color.'%']
                     
                 ])
                 ->orderby('id','desc')
                 ->paginate(15);
                 $features = DB::table('producto')
                 ->get()
                 ->random(3);
 
                 $categorias = DB::table('categoria')
                 ->orderby('titulo','asc')
                 ->get();
                 return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                 return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                 
                 } else if(isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor']) &&
                 isset($_SESSION['color']) &&  isset($_SESSION['marca']) && !isset($_SESSION['categoria'])){


                    $pmajor=$_SESSION['pricemajor'];
                    $pminor=$_SESSION['priceminor'];
                    
                    $color=$_SESSION['color'];
                    $marca=$_SESSION['marca'];
                   
                    
                
                
                    $productos = DB::table('producto')
                    ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                                ->where([
                                     
                                    ['color','LIKE','%'.$color.'%'], 
                                ['titulo','LIKE','%'.$marca.'%']
                                
                                    
                                ])
                                ->orderby('id','desc')
                                ->paginate(15);
                                $features = DB::table('producto')
                                ->get()
                                ->random(3);
                
                                $categorias = DB::table('categoria')
                                ->orderby('titulo','asc')
                                ->get();
                                return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                                return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
    


                    } else if(isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor']) &&
                    isset($_SESSION['color']) && !isset($_SESSION['marca']) && !isset($_SESSION['categoria'])){


                        $pmajor=$_SESSION['pricemajor'];
                        $pminor=$_SESSION['priceminor'];
                        
                        $color=$_SESSION['color'];
                        
                       
                        
                    
                    
                        $productos = DB::table('producto')
                        ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                                    ->where([
                                         
                                        ['color','LIKE','%'.$color.'%']
                                   
                                    
                                        
                                    ])
                                    ->orderby('id','desc')
                                    ->paginate(15);
                                    $features = DB::table('producto')
                                    ->get()
                                    ->random(3);
                    
                                    $categorias = DB::table('categoria')
                                    ->orderby('titulo','asc')
                                    ->get();
                                    return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                                    //return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
        

                    } else if(isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor'])
                    && !isset($_SESSION['categoria']) && !isset($_SESSION['color']) 
                    && !isset($_SESSION['marca'])){



                        $pmajor=$_SESSION['pricemajor'];
                        $pminor=$_SESSION['priceminor'];
                       
                       
                        
                        
                        
                    
                    
                        $productos = DB::table('producto')
                        ->whereBetween('precio_ahora', [$pminor,  $pmajor])
                                    
                                         
                                         
                                   
                                    
                                        
                                    
                                    ->orderby('id','desc')
                                    ->paginate(15);
                                    $features = DB::table('producto')
                                    ->get()
                                    ->random(3);
                    
                                    $categorias = DB::table('categoria')
                                    ->orderby('titulo','asc')
                                    ->get();
                                    return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                                    return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
        

                    } else if(isset($_SESSION['categoria']) && !isset($_SESSION['color']) 
                    && !isset($_SESSION['priceminor']) && !isset($_SESSION['pricemajor']) && !isset($_SESSION['marca'])){



                        $pminor = 0;
                        $pmajor = 3000;
                     
                      
                      $idCat=$_SESSION['idCat'];
                      
                  
                  
                      $productos = DB::table('producto')
                                  ->where([
                                    
                                  ['idcategoria','LIKE','%'.$idCat.'%']
                                      
                                  ])
                                  ->orderby('id','desc')
                                  ->paginate(15);
                                  $features = DB::table('producto')
                                  ->get()
                                  ->random(3);
                  
                                  $categorias = DB::table('categoria')
                                  ->orderby('titulo','asc')
                                  ->get();
                                  return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                                  return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
      

                  }else if(isset($_SESSION['categoria']) && isset($_SESSION['color'])
                  && !isset($_SESSION['priceminor']) && !isset($_SESSION['pricemajor'])
                  && !isset($_SESSION['marca'])){

                    $pminor = 0;
                    $pmajor = 3000;
                 
                  
                  $color=$_SESSION['color'];
                  $idCat=$_SESSION['idCat'];
                  
              
              
                  $productos = DB::table('producto')
                              ->where([
                                ['color','LIKE','%'.$color.'%'],
                              ['idcategoria','LIKE','%'.$idCat.'%']
                                  
                              ])
                              ->orderby('id','desc')
                              ->paginate(15);
                              $features = DB::table('producto')
                              ->get()
                              ->random(3);
              
                              $categorias = DB::table('categoria')
                              ->orderby('titulo','asc')
                              ->get();
                              return view('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
                              return redirect('productos',compact('categorias','productos','buscar','pminor','pmajor','features'));
  

                  } 
                            
                               else{
                              
                    $categorias = DB::table('categoria')
                    ->orderby('titulo','asc')
                    ->get();
                    
                   
           
                   if($request){
                       $pmajor=$request->get('pmajor');
                       $pminor=$request->get('pminor');
                       $buscar=$request->get('buscar');
                       $marca=$request->get('marca');
                       $color=$request->get('color');
                       
           
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
                       //mio
                       else if($color != ''){
                           $buscar=$request->get('buscar');
                           $productos = DB::table('producto')
                           ->where([
                               ['color','LIKE','%'.$color.'%']  
                           ])
                           ->orderby('id','desc')
                           ->paginate(15);
                       }
                       //fin mio
                       else{
                           $pminor = 0;
                           $pmajor = 3000;
                           $marca='';
                           $color='';
                           $productos = DB::table('producto')
                           ->where([
                               ['titulo','LIKE','%'.$buscar.'%'],
                               ['titulo','LIKE','%'.$marca.'%'],  
                               ['color','LIKE','%'.$color.'%']  
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



        
    }

    public function productos_by_cat($categoria){

        $categorias = DB::table('categoria')
        ->orderby('titulo','asc')
        ->get();

        $cat = DB::table('categoria')
        ->where('titulo','=',$categoria)
        ->first();
        
        
        if (isset($categoria) && $categoria != null) {
            $_SESSION['categoria'] = $categoria;
            $_SESSION['idCat'] = $cat->id;
        } 

        $pminor = 0;
        $pmajor = 3000;

        $productos = DB::table('producto')
        ->where([
            ['idcategoria','=',$cat->id]
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
