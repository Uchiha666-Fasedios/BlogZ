<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Jenssegers\Date\Date;//esto lo saqe de la pagina de traducciones hay q ponerlo importar esto q se cargo en vendor por composer (lanzando un comando en la consola)
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\SoftDeletes;//se importa esto para q se pueda agregar esto ['deleted_at'] en la base de datos
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;//esto es de una libreria q se instalo para implementar el borrado logico y se pueda usar esto ForceDelete() y me borre en cascada y delete() de un borrado logico

class Article extends Model
{

//CREANDO MUTADOR q es un metodo y siempre empieza con get

   use TraductorFechas;//es un trait permitíra reutilizar código entre distintas clases sin recurrir a la herencia.
   use SoftDeletes;//uso esto q es de laravel
   use SoftCascadeTrait;//uso el paqete q instale

   protected $dates = ['deleted_at'];//este campo se crea en la base de datos en articles para uso del borrado logico
   protected $softCascade = ['images'];//images es la relacion espesificada mas abajo

   //ACLARO LOS CAMPOS PARA EL METODO MASIVO Q INVOCO EN ArticleController.php
   protected $fillable=['titulo','contenido','activo','theme_id'];


    // Relación de Muchos a Uno

  public function theme(){
    return $this->belongsTo('App\Theme', 'theme_id');
    //return $this->belongsTo(Theme::class);


  }

  // Relación de Muchos a Uno
public function user(){

    return $this->belongsTo('App\User', 'user_id');
   // return $this->belongsTo(User::class);

  }

  //uno a muchos
// $articulo->imagenes
public function images()
{

    return $this->hasMany('App\ArticleImage');
    //return $this->hasMany(ArticleImage::class);

}


public function imagenDestacada()
    {
        $imagenDestacada=$this->images->first();//this refiere a articulo porqe este metodo lo invoco desde la vista articulos.blade.php y el metodo images sin () porqe es una coleccion ya creda desde el controlador de theme entonces estando en el articulo actual cogeme la primera imagen
        if(!$imagenDestacada) //si no es true es q no hay imagen
            return 'sin_imagen.jpg'; //coloco esta
        return $imagenDestacada->nombre;  //esta va pot si no cumple la condicion o sea hay imagen
    }


    //ESTO ES UN QueryScope para no repetir en el codigo esta sintaxis tantas veces q consulta a la base de datos poniendo esto scopeArticulosActivos en el codigo me resumo lo otro
     public function scopeArticulosActivos($query)
    {
        //return $consulta->where('activo','=',1);
        return $query->where('activo',1); //es lo mismo sin el = porqe lo puedo sacar y es lo mismo
    }

    //CON ESTO YA NO NECESITO scopeArticulosActivos YA LO CONVERTI EN PROPIA DEL SISTEMA NI LA TENGO Q INVOCAR A scopeArticulosActivos
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('activo', function ($query) {
            return $query->where('activo', true);
        });
    }

    //ACCESO
    //entonces cuando quiera aplicar esto o sea el campo activo de mi tabla articles dice 1 o 0 pero yo quiero q
    //cuando invoqe a ese campo en alguna vista me ponga si o no por eso hago este quilombo
    //entonces invoco en ves de el nombre real de la propiedad invoco a $estaActivado q va a hacer referencia al campo de la trabla activo
    //pero va a poner en ves de 1 o 0 si o no :)
    public function getEstaActivadoAttribute()
    {
        $EstaActivado=$this->activo;//activo lo saco de la tabla articles es como q la propiedad esta echa Laravel logra eso magia
        if($EstaActivado)
            return 'Si';
        return 'No';
    }


}
