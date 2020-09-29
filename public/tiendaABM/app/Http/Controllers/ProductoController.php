<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria;
use App\Producto;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    function index(Request $request){
        if($request){

            $buscar = $request->get('buscar');
            $productos = DB::table('producto')
            ->where('titulo','LIKE','%'.$buscar.'%')
            ->paginate(20);

            return view('admin.producto.index',compact('buscar','productos'));
        }
    }

    function create(){

        $categorias = DB::table('categoria')
        ->get();

        return view('admin.producto.create',compact('categorias'));
    }

    function store(Request $request){

        $validator = $request->validate([
            'titulo'=>'required|max:250|unique:producto',
            'contenido'=>'required',
            'idcategoria'=>'required',
            'precio_antes'=>'required',
            'precio_ahora'=>'required',
            'poster'=>'required|max:10000',
            'stock'=>'required',
        ]);

        try{
            

            $imgname = uniqid();
            $poster = $request->poster->extension();

            if($poster == 'png' || $poster == 'jpeg' || $poster == 'jpg' || $poster == 'webp'){
                $producto = new Producto;
                $producto->titulo = $request->get('titulo');
                $producto->contenido = $request->get('contenido');
                $producto->idcategoria = $request->get('idcategoria');
                $producto->precio_ahora = $request->get('precio_ahora');
                $producto->precio_antes = $request->get('precio_antes');
                $producto->stock = $request->get('stock');
                $producto->estado = 'DISPONIBLE';
                $producto->resena = $request->get('resena');
                $producto->slug = Str::slug($request->get('titulo'),'_');
                $producto->num_ventas = 0;

                $imageName = $imgname.'.'.$request->poster->extension();  
                $request->poster->move(public_path('poster'), $imageName);
                $producto->poster = $imageName;
                $producto->save();
        
                try {
                    $foto = $request->file('foto');
                    $registros = count($foto);

                    
                    $cont=0;
                    while($cont<$registros){
                        $galeria=new Galeria;
                        $galeria->idproducto=$producto->id;/*ID AUTOGENERADO*/
                        $codigo = uniqid();
                        $foto[$cont]->move(public_path().'/soporte_img',$codigo.".".$foto[$cont]->getClientOriginalExtension());
                        $galeria->foto=$codigo.".".$foto[$cont]->getClientOriginalExtension();                   
                        $galeria->save(); 
                        $cont = $cont+1;
                    }
                } catch (\Exception $e) {
                    Session::flash('danger', 'No ingresó imagenes para el producto');
                    return redirect()->back();
                }
                Session::flash('succes', 'Se registró su producto con exito');
                return Redirect::to('admin/productos');
            }else{
                Session::flash('danger', 'El formato de las imagenes no estan aceptadas');
                return redirect()->back();
            }
        }catch(\Exception $e){
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function edit($slug){
        $producto = Producto::where('slug',$slug)->firstOrFail();
        $categorias = DB::table('categoria')
        ->get();

        return view('admin.producto.edit',compact('producto','categorias'));
    }

    public function update(Request $request, $slug){
        $validator = $request->validate([
            'titulo'=>'required|max:250|unique:producto,titulo,'.$slug.',slug',
            'contenido'=>'required',
            'idcategoria'=>'required',
            'precio_antes'=>'required',
            'precio_ahora'=>'required',
            'poster'=>'max:10000',
            'stock'=>'required',
            'resena'=>'required|max:500',
            
        ]);

        try {

            $imgname = uniqid();
            if($request->hasFile('poster')){
          
                $poster = $request->poster->extension();

                if($poster == 'png' || $poster == 'jpeg' || $poster == 'jpg' || $poster == 'webp'){

                    $producto = Producto::where('slug',$slug)->firstOrFail();
                    $producto->titulo = $request->get('titulo');
                    $producto->contenido = $request->get('contenido');
                    $producto->idcategoria = $request->get('idcategoria');
                    $producto->precio_ahora = $request->get('precio_ahora');
                    $producto->precio_antes = $request->get('precio_antes');
                    $producto->stock = $request->get('stock');
                    $producto->resena = $request->get('resena');
                    $producto->estado = 'DISPONIBLE';
                    $producto->slug = Str::slug($request->get('titulo'),'_');

                    try{
                        unlink(public_path('poster/'.$producto->poster));
                    }
                    catch(\Exception $e){
                        
                    }

                    $imageName = $imgname.'.'.$request->poster->extension();  
                    $request->poster->move(public_path('poster'), $imageName);
                    $producto->poster = $imageName;
                    $producto->update();
            
                    
                    Session::flash('succes', 'Se actualizó su producto con exito');
                    return Redirect::to('admin/productos');
                }else{
                    Session::flash('danger', 'El formato de las imagenes no estan aceptadas');
                    return redirect()->back();
                }
            }else{
              
                $producto = Producto::where('slug',$slug)->firstOrFail();
                $producto->titulo = $request->get('titulo');
                $producto->contenido = $request->get('contenido');
                $producto->idcategoria = $request->get('idcategoria');
                $producto->precio_ahora = $request->get('precio_ahora');
                $producto->precio_antes = $request->get('precio_antes');
                $producto->stock = $request->get('stock');
                $producto->estado = 'DISPONIBLE';
                $producto->slug = Str::slug($request->get('titulo'),'_');
                $producto->resena = $request->get('resena');
                $producto->update();

                Session::flash('succes', 'Se actualizó su producto con exito');
                return Redirect::to('admin/productos');
            }
        } catch (\Exception $e) {
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function aumentar_stock(Request $request,$id){
        $validator = $request->validate([
            'stock'=>'required|numeric',
        ]);
        
        try {
            

            
            $producto = Producto::findOrFail($id);
            $producto->stock = $producto->stock + $request->get('stock');
            $producto->update();

            Session::flash('succes', 'Se aumento el stock del producto');
            return Redirect::to('admin/productos');

        } catch (\Exception $e) {
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function galeria($slug){

        $producto = Producto::where('slug',$slug)->firstOrFail();
        
        $galeria = DB::table('galeria')
        ->where('idproducto','=',$producto->id)
        ->orderby('id','desc')
        ->get();

        return view('admin.producto.galeria',compact('producto','galeria'));
    }

    public function agregar_imagen(Request $request){
        try {
            $validator = $request->validate([
                'foto'=>'max:5000',
            ]);

            $foto = $request->foto->extension();

            if($foto == 'png' || $foto == 'jpeg' || $foto == 'jpg' || $foto == 'webp'){
                $galeria = new Galeria;
                $imgname = uniqid();
                $imageName = $imgname.'.'.$request->foto->extension();  
                $request->foto->move(public_path('soporte_img'), $imageName);
                $galeria->foto = $imageName;
                $galeria->idproducto = $request->get('idproducto');
                $galeria->save();

                Session::flash('succes', 'Se subió la imagen con exito');
                return redirect()->back();
            }else{
                Session::flash('danger', 'El formato de las imagenes no estan aceptadas');
                return redirect()->back();
            }
            
        } catch (\Exception $e) {
         
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function destroy_imagen($id){

        $galeria = Galeria::findOrFail($id);
        try{
            unlink(public_path('soporte_img/'.$galeria->foto));
        }
        catch(\Exception $e){
            
        }
        $galeria->delete();

        Session::flash('succes', 'Se eliminó la imagen correctamente');
        return redirect()->back();

    }

    public function destroy_producto($id){

        $producto = Producto::findOrFail($id);
        try{
            unlink(public_path('soporte_img/'.$producto->psoter));
        }
        catch(\Exception $e){
            
        }
        $producto->delete();

        Session::flash('succes', 'Se eliminó el producto correctamente');
        return redirect()->back();

    }
}
