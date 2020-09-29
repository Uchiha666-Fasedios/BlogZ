<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//ESTA CLASE SE AGREGO AUTOMATICAMENTE ES PARA EL REGISTRO
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'role', 'name', 'surname', 'nick', 'email', 'password',//estos son los campos de registro de usuario
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function images(){
    return $this->hasMany('App\Image');//saco todas las imagenes cuyo usuario sea el q yo estoy sacando ahora y ya funcionaria
    }
}
