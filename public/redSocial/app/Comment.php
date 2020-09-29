<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comments';

// Relación de Muchos a Uno
public function user(){
  return $this->belongsTo('App\User', 'user_id');//todo lo q tenga relacion de comentario user_id con el id de User
}

// Relación de Muchos a Uno
public function image(){
  return $this->belongsTo('App\Image', 'image_id');//todo lo q tenga relacion con ..  image_id de comments y id de Image
}
}
