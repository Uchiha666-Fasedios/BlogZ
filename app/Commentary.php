<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Commentary extends Model
{
	use SoftDeletes;
    use SoftCascadeTrait;

    protected $dates = ['deleted_at'];

	// $commentary->article
    public function article()
	{//relacion uno a uno
		return $this->belongsTo(Article::class);//un comentario pertenece a un articulo
	}

	// $commentary->user
    public function user()
	{//relacion uno a uno
		return $this->belongsTo(User::class); // un comentario pertenese a un usuario
	}
}
