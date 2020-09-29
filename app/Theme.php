<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;//se importa esto para q se pueda agregar esto ['deleted_at'] en la base de datos
use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;//esto es de una libreria q se instalo para implementar el borrado logico y se pueda usar esto ForceDelete() y me borre en cascada y delete() de un borrado logico

class Theme extends Model
{
    use TraductorFechas;
    use SoftDeletes;//uso esto q importe arriba es paqete de laravel
    use SoftCascadeTrait;//uso el paqete q instale
    //esto se pone cuando quiero trabajar con algo q no sea el id

   protected $dates = ['deleted_at'];//este campo se crea en la base de datos en articles para uso del borrado logico
   protected $softCascade = ['articles'];// articles es la relacion q tiene el tema con los articulo q se espesifico mas abajo
    //ACLARO LOS CAMPOS Q QUIERO PARA Q SE TOMEN DE FORMA MASIVA EL EJEMPLO ESTA EN EL CONTROLADOR ACCION STORE
    protected $fillable=['nombre','destacado','suscripcion'];

    public function getRouteKeyName()
    {

        return 'slug';

    }

////////////////////////////////////////////////////////////////////

    // Relación de Muchos a Uno

  public function user(){
    return $this->belongsTo('App\User', 'user_id');
    //return $this->belongsTo(User::class);

  }

  // Relación One To Many
public function articles(){

    return $this->hasMany('App\Article');
    //return $this->hasMany(Article::class);
  }


  //ACCESOS
  //EN ESTE CASO LO Q HAGO ES PONER getEsDestacadoAttribute LE PONGO EL Es PORE REPERCUTA EN TODO Y ESTA VEZ NO QUIERO Q SEA ASI
  //ENTONCES CADA VES Q QUIERA LLAMAR A ESTE METODO Y Q SE CUMPLA ESTO LO LLAMO DESDE UNA VISTA PERO PONIENDO EsDestacado
  //Y SI QUIERO Q EN LA VISTA ME MUESTRE 1 o 0 pongo solo destacado y me tira lo real de la tabla
  //los accesos hacen referencia al nombre de una columna de la tal tabla
  //estoy creando dos ACCESOS q es para poner en una vista si o no  dicho campo de dicha tabla
  public function getEsDestacadoAttribute()//tengo q poner get siempre y Destacado porqe tiene q coincidir con el nombre del campo en la tabla q quiero cambiar
  {
      $esDestacado=$this->destacado; // $this->destacado aca invoco al campo de la tabla y lo pongo en la variable
      if($esDestacado)//si es 1 es true y entro
          return 'Si';
          //si no
      return 'No';
  }

  public function getEsSuscripcionAttribute()
  {
     $esSuscripcion=$this->suscripcion;
      if($esSuscripcion)
          return 'Si';
      return 'No';
  }
////////////////////fin de accesos/////////////////





}
