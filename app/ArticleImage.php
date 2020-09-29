<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//se importa esto para q se pueda agregar esto ['deleted_at'] en la base de datos
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;//esto es de una libreria q se instalo para implementar el borrado logico y se pueda usar esto ForceDelete() y me borre en cascada y delete() de un borrado logico



class ArticleImage extends Model
{
   use SoftDeletes;//uso esto q importe arriba es paqete de laravel
    use SoftCascadeTrait;//uso el paqete q instale

   protected $dates = ['deleted_at'];//este campo se crea en la base de datos en articles para uso del borrado logico
    //$articuloImagen->articulo

    //de muchos a uno
    public function article()
	{
        //return $this->belongsTo(Article::class);
        return $this->belongsTo('App\Article', 'article_id');

    }





}
