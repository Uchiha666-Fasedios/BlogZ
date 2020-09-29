<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Theme;
use App\Jobs\BorrarTema;//COLA DE TRABAJO
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;//importo para q ande lo de rule

class ThemeController extends Controller
{

    public function index()
    {
        $miga='Temas';//guardo esta variable para q me muestre en el header la palabra Temas cuando voy a la vista
    	$temas=Theme::orderBy('id','desc')->get();
	    return view('admin.temas.index')->with(compact('temas','miga'));//me llevo las variables a la vista
    }


    public function create()
    {
        $miga='Añadir Tema';
        return view('admin.temas.create')->with(compact('miga'));
    }


    public function store(Request $request)
    {

        $messages=[
            'nombre.required'=>'El campo Nombre no puede quedar vacio',
            'nombre.unique'=>'El nombre de este tema ya existe'
        ];

        $rules=[
            'nombre'=>'required|unique:themes'
        ];
//recogemos estos dos input q llegan del formulario
        $destacado=$request->destacado;
        $suscripcion=$request->suscripcion;
//le preguntamos si son true los dos o sea si se eligio 1 y 1 entro al if
        if($destacado && $suscripcion)
        {
            $notificacion2="Un tema de suscripción no puede estar en la pagina de inicio";
            return back()->with(compact('notificacion2'));
        }

        $this->validate($request, $rules, $messages);//validate hace la magia de validacion y tiene en cuenta las variables q le pase

//all pero esto toma todos de forma masiva todos los de la tabla themes pero en el modelo aclaro los q quiero q funcionen
        $tema=new Theme($request->all());//ME AHORRO DE PONER UNO POR UNO LO Q ME LLEGA DEL FORMULARIO tomo lo q me llega del formulario de forma masiva .. TAMBIEN POR SEGURIDAD EN EL MODELO THEMA ACLARO LOS CAMPOS Q TOMA MASIVAMENTE

        // $tema=new Theme();
       // $tema->nombre=$request->nombre;
        //$tema->destacado=$request->destacado;
        //$tema->suscripcion=$request->suscripcion;
        $tema->user_id=auth()->user()->id;
        $tema->slug=mb_strtolower((str_replace(" ","-",$request->nombre)),'UTF-8');//mb_strtolower q todos los caracteres sean minuscula.. str_replace(" ","-" q los espacios en blanco me lo sustitullas por - ..$request->nombre q el slug tenga el nombre.. 'UTF-8' se pone para q no de error cuando pongo una tilde o eñe
        $tema->save();
        $temaNombre = $tema->nombre;
        $notificacion="El tema $temaNombre se ha añadido correctamente";
        return back()->with(compact('notificacion'));
    }



    public function show($id)
    {
        //
    }


    public function edit(Theme $tema)
    {
        $miga='Editar Tema';//guardo esta variable para q me muestre en la vista la palabra Temas cuando voy a la vista en views/layouts/appAdmin.blade.php la puedo ver
        return view('admin.temas.edit')->with(compact('tema','miga'));
    }


    public function update(Request $request, Theme $tema)//Request $request esto se pone siempre para recoger lo q llega del formulario
    {
        $messages=[
            'nombre.required'=>'El campo Nombre no puede quedar vacio',
            'nombre.unique'=>'El nombre de este tema ya existe'
        ];

        $rules=[
            'nombre' => ['required',Rule::unique('themes')->ignore($tema->id)] //Rule::unique('themes')->ignore($tema->id) ACA LE DIGO Q me ignore el tema de mi mismo o sea q no me diga q esta repetido el tema mio mismo

        ];
//recogemos estos dos input q llegan del formulario
        $destacado=$request->destacado;
        $suscripcion=$request->suscripcion;
//le preguntamos si son true los dos o sea si se eligio 1 y 1 entro al if
        if($destacado && $suscripcion)
        {
            $notificacion2="Un tema de suscripción no puede estar en la pagina de inicio";
            return back()->with(compact('notificacion2'));//back() vuelvo para atras con el mensaje
        }

        $this->validate($request, $rules, $messages);

       /* $tema->nombre=$request->nombre;
        $tema->destacado=$request->destacado;
        $tema->suscripcion=$request->suscripcion;
        $tema->save();//PARA ACTUALIZAR UN SOLO REGISTRO SE UTILIZA SAVE()*/

        //ME AHORRO DE PONER UNO POR UNO LO Q ME LLEGA DEL FORMULARIO tomo lo q me llega del formulario de forma masiva .. TAMBIEN POR SEGURIDAD EN EL MODELO THEMA ACLARO LOS CAMPOS Q TOMA MASIVAMENTE
        //HAGO CARGA MASIVA Y PONGO UPDATE PORQE PARA UTILIZAR ESTE METODO CUANDO ACTUALIZO TENGO Q PONER EL UPDATE POR MAS Q SEA UN REGISTRO A ACTUALIZAR
        $tema->update($request->all());//all pero esto toma todos de forma masiva todos los de la tabla themes pero en el modelo aclaro los q quiero q funcionen
        $miga='Temas';
        $notificacion2='El tema se ha actualizado correctamente';
        return redirect('admin/temas')->with(compact('notificacion2','miga'));//redirecciono a la lista de los temas
        //return back()->with(compact('notificacion'));
    }


    public function destroy(Theme $tema)
    {
//forma compleja
/*
$articulos=$tema->articles()->with(['images'])->get();
foreach ($articulos as $articulo){
    foreach ($articulo->images as $image){
        //Storage::disk('public')->delete('/imagenesArticulos/'.$image->nombre);
        Storage::disk('imagenesArticulos')->delete($image->nombre);
        //Storage::disk('images')->delete($image->image_path);
    }
$articulo->images()->delete();
$articulo->delete();
}
$tema->delete();
return back();*/

//forma facil
//ESTE METODO NO BORRA DE FORMA CASCADA PARA ELLO SE DEBE INSTALAR UN PAQETE EXTERNO
       $tema->ForceDelete();//ForceDelete esto para borrarlo peermanente si quiero logico va delete por conviccion
        //BorrarTema::dispatch($tema); //LLAMO A LA COLA DE TRABAJO (enclo este trabajo)
        $notificacion="El tema se ha eliminado";
        return back()->with(compact('notificacion'));
    }
}
