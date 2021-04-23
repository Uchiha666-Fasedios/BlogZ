<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\SliderImage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miga='Slider';
        return view('admin.slider')->with(compact('miga'));//esto carga \views\admin\slider.blade.php
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path=$request->file('file')->store('public/imagenesSlider');//->store metodo para guardar archivo SOLAMENTE si viene del input guardo el archivo en la direccion esa /public/imagenesSlider y guardo la ruta en la variable
        $nombreImagen = collect(explode('/', $path))->last();//qeremos q coga desde la ultima barra en adelante o sea el nombre
        $extensionImagen = collect(explode('.', $path))->last();//recoge lo q hay despues del ultimo punto o sea la extencion
        $imagen = Image::make(Storage::get($path));//Storage::get($path) sacamos la imagen de donde esta.. Image::make creamos una instancia de dicha imagen un objeto
        $imagen->resize(1920,1080);//y con el objeto imagen q tiene la imagen la redimensionamos a nuestro gusto
        Storage::put($path,$imagen->encode($extensionImagen, 75));//para recojer la imagen guardada en la carpeta store uso Storage::put y put porqe le actualizo algo.. encode este metodo viene de la libreria q instalamos q resive 2 parametros 75 es la calidad de 1 a 100
        $imagen=new SliderImage();//creo el objeto imagen
        $imagen->nombre = $nombreImagen;//meto el nombre de la imagen en el objeto
        // Agregamos el orden de la nueva imagen
        $posicionFinal=SliderImage::max('orden');//el orden maximo 1, 2 o 3
        if(is_null($posicionFinal))//si es nulo es q no hay ninguna imagen
        {
            $orden=1;//entonces el 1 va ser el mayor
        }else{
            $orden=($posicionFinal)+1;//si no el maximo numero q hay + 1
        }
        //
        $imagen->orden=$orden;
        $imagen->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $imagen=SliderImage::findOrFail($id);//findOrFail encuentra la imagen con tal id
        Storage::disk('public')->delete('/imagenesSlider/'.$imagen->nombre);//la borramos fisicamente de la carpeta
        $imagen->delete();//la borramos de la base de datos
    }

    public function imagenesMostrarAxios()
    {
        $imagenes=SliderImage::all();//encuentra todas las imagenes
        foreach($imagenes->sortBy('orden') as $imagen)//sortBy('orden') se vn a ordenar en vez de por id por el orden
        {//Storage::url('imagenesSlider/'.$imagen->nombre) sacamos de la carpeta de las imagenes la imagen para q se muestre
            //onclick="eliminarImagen('.$imagen->id.') le doy clik a eliminar y ejecuto tal funcion
            echo    '<div style="cursor:move;border: solid 1px; margin-top: 2px; padding: 0" class="col-xs-6 col-xs-offset-3 imagen" id="'.$imagen->orden.'">
                        <img class="mover" width="100px" src="'.url('http://www.adrianweb.live/storage/imagenesSlider/'.$imagen->nombre).'">
                        <img style="cursor: pointer; float: right; margin: 8px 8px 0px 0px" width="20px" onclick="eliminarImagen('.$imagen->id.')" src="'.asset('imagenes/admin/eliminar.png').'">
                    </div>';
        }
    }

    public function imagenesOrdenarAxios($posicionInicial,$posicionFinal,$ultimo) // este se invoca de \views\admin\slider.blade.php
    {
        if($ultimo=="false")// esto se cumple mientras no arrastremos la imagen a lo ultimo
        {
            // Con la posición inicial sabemos que imagen se ha movido, con la posición final donde se va a colocar.
         
            if($posicionInicial < $posicionFinal)//La persona está cambiando las imágenes de arriba hacia abajo.
            {
                $imagenMovida = SliderImage::where('orden',$posicionInicial)->first();//buscame la imagen cuyo orden sea ese
                $posicionFinalReal=$posicionFinal-1;//le resto para agaarar la posicion real acordate q en slider.blade agarre la siguiente

                $inicio=$posicionInicial+1;
                for($inicio; $inicio <= $posicionFinalReal; $inicio++)
                {
                    $imagen = SliderImage::where('orden',$inicio)->first();//la imagen q elegi q tenia el orden inicial pillamela
                    if($imagen!=null)
                    {
                        $ordenInicial=$imagen->orden;//le ponemos el orden
                        $ordenFinal=$ordenInicial - 1;
                        $imagen->orden=$ordenFinal;
                        $imagen->save();
                    }
                }

                $imagenMovida->orden=$posicionFinalReal;
                $imagenMovida->save();
            }

            // La persona está cambiando las imágenes de abajo hacia arriba.
            if($posicionInicial > $posicionFinal)//esto se cumple cuando estemos cambiando las imagenes de abajo hacia arriba
            {
                $imagenMovida = SliderImage::where('orden',$posicionInicial)->first();

                $inicio=$posicionInicial-1;
                for($inicio; $inicio >= $posicionFinal; $inicio--)
                {
                    $imagen = SliderImage::where('orden',$inicio)->first();
                    if($imagen!=null)//esto lo ponemos porqe si borra la imagen daria error
                    {
                        $ordenInicial=$imagen->orden;
                        $ordenFinal=$ordenInicial+1;
                        $imagen->orden=$ordenFinal;
                        $imagen->save();
                    }
                }

                $imagenMovida->orden=$posicionFinal;
                $imagenMovida->save();
            }
        }
        if($ultimo=="true")// esto se cumple cuando arrastremos la imagen a lo ultimo
        {
            // Con la posición inicial sabemos que imagen se ha movido, con la posición final donde se va a colocar.
            // La persona está cambiando las imágenes de arriba hacia abajo.
                $imagenMovida = SliderImage::where('orden',$posicionInicial)->first();
                $posicionFinalReal=SliderImage::max('orden');

                $inicio=$posicionInicial+1;
                for($inicio; $inicio <= $posicionFinalReal; $inicio++)
                {
                    $imagen = SliderImage::where('orden',$inicio)->first();
                    if($imagen!=null)//esto lo ponemos porqe si borra la imagen daria error
                    {
                        $ordenInicial=$imagen->orden;
                        $ordenFinal=$ordenInicial - 1;
                        $imagen->orden=$ordenFinal;
                        $imagen->save();
                    }
                }

                $imagenMovida->orden=$posicionFinalReal;
                $imagenMovida->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
