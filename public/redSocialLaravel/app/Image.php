<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $table = 'images';//le indico cual va ser la tabla q va a modificar este modelo

// Relación One To Many / de uno a muchos
//CUANDO LLAME A ESTE METODO.. LA RELACION ACA ES DEL ID DE IMAGES CON IMAGE_ID DE CommentS (al poner esto hasMany)
public function comments(){
  return $this->hasMany('App\Comment')->orderBy('id', 'desc');//hasMany('App\Comment')quiero q trabaje con el objeto App\Comment,
  //esto lo q hace es q mediante el id de image q halla guardado tambien en Comment esto va hacer la magia por detras y ME VA A CONSEGUIR cuando YO llame a Comment
  //el objeto de los comentarios
  //DE ESTA MANERA CUANDO YO CREE EL OBJETO IMAGE PODRE LLAMAR A ESTE METODO Y ESTE METODO INTERACTUARA CON LA OTRA ENTIDAD Y VERA Q TENGO OTRO ID AHI GUARDADO (image_id) DE LA image_type_to_extension
  //Q SIRVE PARA HACER LA RELACION Y ENTONCES ME VA A SACAR UNA ARRAY DE esoS COMENTARIOS
}

// Relación One To Many
public function likes(){
  //LO MISMO CON LOS LIKE //CUANDO LLAME A ESTE METODO.. LA RELACION ACA ES DEL ID DE IMAGES CON IMAGE_ID DE Likes (al poner esto hasMany)
  return $this->hasMany('App\Like');
}

// Relación de Muchos a Uno
//ACA CUANDO SE LLAMA A ESTE METODO... LA RELACION ACA ES el id DE User CON el user_id DE Image (al poner esto belongsTo) esto App\User quiere decir q voy a trabajar con la clase User
public function user(){
  return $this->belongsTo('App\User', 'user_id');//ACA ES DE MUCHOS A UNO PORQE VOY A BUSCAR en usuarios todo lo q se relacione con id de users con user_id de images
  //y crear los objetos. o sea de un id de images(user_id) a todos lo del id de users
}
}
