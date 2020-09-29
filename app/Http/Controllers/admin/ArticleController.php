<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\ArticleImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;//importamos la libreria para poner el tamaño deseado de la imagen TODAS LAS LIBRERIA Q SE CREAN DESDE LA CONSOLA SE INSTALAN EN VENDOR
use Illuminate\Validation\Rule;//importo para q ande lo de rule


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miga='Artículos';
        $todosArticulos=Article::withoutGlobalScope('activo')->count();//withoutGlobalScope('activo') invoca todos los articulos pero q no tenga en cuenta me cuenta GLOBASCOPE q se hizo en el modelo article ..count() los cuenta
         //withoutGlobalScope('activo') CON ESTO LE ESTOY DICIENDO Q ME INVOQE LOS ARTICULOS SIN TENER EN CUENTA EL GLOBASCOPE Q SE HIZO EN EL MODELO ARTICLE PARA EL CAMPO ACTIVO (PORQE QUIERO Q SE MUESTRE TANTO LOS ACTIVOS COMO LOS INACTIVOS)
        $articulos=Article::withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->paginate(10);//with(['user','theme']) CON ESTO Q ME TRAIGA EL USUARIO Y EL TEMA DE ESTE ARTICULO PORQE SI TE FIJAS EN EL MODELO ARTICLE EN LA FUNCION USER Y THEME LO CONSIGO

        return view('admin.articulos.index')->with(compact('miga','articulos','todosArticulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $miga='Añadir Articulo';
        return view('admin.articulos.create')->with(compact('miga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=[
            'titulo.required'=>'El campo Título no puede quedar vacio',
            'titulo.unique'=>'El Título de este articulo ya existe',
            'contenido'=>'El campo Contenido no puede quedar vacio',
            'foto0.mimes'=>'No es una imagen',
            'foto0.max'=>'Archivo demasiado grande',
            'foto1.mimes'=>'No es una imagen',
            'foto1.max'=>'Archivo demasiado grande',
            'foto2.mimes'=>'No es una imagen',
            'foto2.max'=>'Archivo demasiado grande'
        ];

        $rules=[
            'titulo'=>'required|unique:articles',
            'contenido'=>'required',
            'foto0' => 'mimes:jpeg,png|max:1048',
            'foto1' => 'mimes:jpeg,png|max:1048',
            'foto2' => 'mimes:jpeg,png|max:1048'
        ];

        $this->validate($request, $rules, $messages);

        //only..la diferencia con el metodo all() es q agarra solo los q le indico de parametro es q no quiero q agarre lo de la imagen.. tambien se aclaran en el modelo Article
        //importante para q funcione poner los nombres de los input con el mismo nombre de los campos de la tabla
        $articulo=new Article($request->only('titulo','contenido','activo','theme_id'));//ME AHORRO DE PONER UNO POR UNO LO Q ME LLEGA DEL FORMULARIO tomo lo q me llega del formulario de forma masiva
        /*$articulo=new Article();
        $articulo->activo=$request->activo;
        $articulo->titulo=$request->titulo;
        $articulo->theme_id=$request->theme_id;
        $articulo->contenido=$request->contenido;*/
        $articulo->user_id=auth()->user()->id;
        $articulo->save();

        // Guardar la imgagen en nuestro proyecto
//doy tres vueltas
        for($i=0;$i<3;$i++)
        {
            if($request->hasFile('foto'.$i))//existe un archivo llamado foto $i q seria alguno de estos 0,1,2 si existe entro al if
            {
               $path=$request->file('foto'.$i)->store('public/imagenesArticulos');//->store metodo para guardar archivo SOLAMENTE si viene del input guardo el archivo en la direccion esa store/public/imagenesArticulos y guardo la ruta en la variable
               $nombreImagen = collect(explode('/', $path))->last();//qeremos q coga desde la ultima barra en adelante o sea el nombre
               $extensionImagen = collect(explode('.', $path))->last();//recoge lo q hay despues del ultimo punto o sea la extencion
               $imagen = Image::make(Storage::get($path));//Storage::get($path) sacamos la imagen de donde esta.. Image::make creamos una instancia de dicha imagen un objeto
               $imagen->resize(300,250);//y con el objeto imagen q tiene la imagen la redimensionamos a nuestro gusto
               Storage::put($path,$imagen->encode($extensionImagen,99));//para recojer la imagen guardada en la carpeta store uso Storage::put y put porqe le actualizo algo.. encode este metodo viene de la libreria q instalamos q resive 2 parametros 75 es la calidad de 1 a 100
               $imagen=new ArticleImage();//creo el objeto imagen
               $imagen->nombre = $nombreImagen;//meto el nombre de la imagen en el objeto
               $imagen->article_id = $articulo->id;//meto el id del articulo en el objeto
               $imagen->save();
            }
        }


        $articuloTitulo = $articulo->titulo;
        $notificacion="El artículo $articuloTitulo se ha añadido correctamente";
        return back()->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //withoutGlobalScope con esto le decimos q no tenga en cuenta el globalScope creado en Articles..findOrFail encuentra el articulo con tal id y OrFail se pone por se le estamos pasando un id de un articulo q no existe
        //TODO ESTO POR EL GLOBALSCOPE Q SE HIZO Q EVITA Q ME MUESTRE TODOS LOS ARTICULOS (SOLO LOS ACTIVOS)
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $miga='Mostrar Artículo';
        return view('admin.articulos.show')->with(compact('miga','articulo'));
    }


    public function edit($id)
    {//withoutGlobalScope con esto le decimos q no tenga en cuenta el globalScope creado en Articles..findOrFail encuentra el articulo con tal id y OrFail se pone por se le estamos pasando un id de un articulo q no existe
        //TODO ESTO POR EL GLOBALSCOPE Q SE HIZO Q EVITA Q ME MUESTRE TODOS LOS ARTICULOS (SOLO LOS ACTIVOS)
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $miga='Editar Artículo';
        return view('admin.articulos.edit')->with(compact('articulo','miga'));
    }


    public function update(Request $request, $id)
    {
        //withoutGlobalScope con esto le decimos q no tenga en cuenta el globalScope creado en Articles..findOrFail encuentra el articulo con tal id y OrFail se pone por se le estamos pasando un id de un articulo q no existe
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $messages=[
            'titulo.required'=>'El campo Título no puede quedar vacio',
            'titulo.unique'=>'El Título de este articulo ya existe',
            'contenido'=>'El campo Contenido no puede quedar vacio',
            'foto1.mimes'=>'No es una imagen',
            'foto1.max'=>'Archivo demasiado grande',
            'foto2.mimes'=>'No es una imagen',
            'foto2.max'=>'Archivo demasiado grande',
            'foto3.mimes'=>'No es una imagen',
            'foto3.max'=>'Archivo demasiado grande'
        ];

        $rules=[
            'titulo' => ['required',Rule::unique('articles')->ignore($articulo->id)],
            'contenido'=>'required',
            'foto1' => 'mimes:jpeg,png|max:1048',
            'foto2' => 'mimes:jpeg,png|max:1048',
            'foto3' => 'mimes:jpeg,png|max:1048'
        ];

        $this->validate($request, $rules, $messages);

        /*$articulo->activo=$request->activo;
        $articulo->titulo=$request->titulo;
        $articulo->theme_id=$request->theme_id;
        $articulo->contenido=$request->contenido;
        $articulo->save();*/

        //only..la diferencia con el metodo all() es q agarra solo los q le indico de parametro es q no quiero q agarre lo de la imagen.. tambien se aclaran en el modelo Article
        //importante para q funcione poner los nombres de los input con el mismo nombre de los campos de la tabla
        strip_tags($request->contenido);
        $articulo->update($request->only('titulo','contenido','activo','theme_id'));//ME AHORRO DE PONER UNO POR UNO LO Q ME LLEGA DEL FORMULARIO tomo lo q me llega del formulario de forma masiva

        // Guardar la imgagen en nuestro proyecto

        for($i=1;$i<4;$i++)
        {
            if($request->hasFile('foto'.$i))
            {
               $path=$request->file('foto'.$i)->store('public/imagenesArticulos');//->store metodo para guardar archivo SOLAMENTE si viene del input guardo el archivo en la direccion esa store/public/imagenesArticulos y guardo la ruta en la variable
               $nombreImagen = collect(explode('/', $path))->last();//qeremos q coga desde la ultima barra en adelante o sea el nombre
               $extensionImagen = collect(explode('.', $path))->last();//recoge lo q hay despues del ultimo punto o sea la extencion
               $imagen = Image::make(Storage::get($path));//Storage::get($path) sacamos la imagen de donde esta.. Image::make creamos una instancia de dicha imagen un objeto
               $imagen->resize(300,250);//y con el objeto imagen q tiene la imagen la redimensionamos a nuestro gusto
               Storage::put($path,$imagen->encode($extensionImagen,99));//para recojer la imagen guardada en la carpeta store uso Storage::put y put porqe le actualizo algo.. encode este metodo viene de la libreria q instalamos q resive 2 parametros 75 es la calidad de 1 a 100
               $imagen=new ArticleImage();//creo el objeto imagen
               $imagen->nombre = $nombreImagen;//meto el nombre de la imagen en el objeto
               $imagen->article_id = $articulo->id;//meto el id del articulo en el objeto
               $imagen->save();
            }
        }

        $miga='Artículos';
        $notificacion="El artículo se ha actualizado correctamente";
        return redirect('admin/articulos')->with(compact('notificacion','miga'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //withoutGlobalScope con esto le decimos q no tenga en cuenta el globalScope creado en Articles..findOrFail encuentra el articulo con tal id y OrFail se pone por se le estamos pasando un id de un articulo q no existe
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        foreach($articulo->images as $imagen)//con un bucle voy borrando todas
        {
            // lo borramos físicamente
            Storage::disk('imagenesArticulos')->delete($imagen->nombre);//la borramos fisicamente de la carpeta
        }
        $articulo->delete();
        $notificacion2="El articulo se ha eliminado";
        return back()->with(compact('notificacion2'));
    }
}
