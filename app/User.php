<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{

    use TraductorFechas;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'alias', 'web', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


// Relación One To Many
public function themes(){

    return $this->hasMany('App\Theme');
  }

// Relación One To Many
  public function articles()
  {
      return $this->hasMany('App\Article');
  }

  //relacion de muchos a muchos
  public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

  //ACCESOS
  //estoy creando un ACCESO q es para poner en una vista en este caso mayuscula dicho campo de dicha tabla
     /* public function getNameAttribute($valor)//tengo q poner get siempre y Name porqe tiene q coincidir con el nombre del campo en la tabla q quiero cambiar va eso creo
    {
        return ucfirst(strtolower($valor));//ucfirst me transforma la primera en mayuscula ..strtolower con esto me tranforma las demas en minuscula
    }*/

    //MUTADORES
    //lo mismo q accesos pero este ya lomete bien a la tabla con mayuscula la primera el otro solo la muestra
    public function setNameAttribute($value)
    {
        $this->attributes['name']=ucfirst(mb_strtolower($value,'UTF-8'));//'UTF-8' ESTO LO METO PORQE SI NO DA ERROR
    }

    //acceso
    public function getUsuarioRolesAttribute()
    {
        $roles=$this->roles;//cogemos todos los roles q tiene el usuario
            foreach ($roles as $role)//con este bucle me saca los roles para mostrarlos en la vista
            {
                    echo $role->nombre."<br>";//y los vamos mostrando a los roles
            }
    }

    public function getUsuarioBloqueadoAttribute()
    {
        $bloqueado=$this->bloqueado;//coge un 1 o un 0 depende si el usuario esta blokeado o no
        if(!$bloqueado)
            return "No Bloqueado";
        return "Bloqueado";
    }


    public function hasRole($role) //recibe el rol
    {
        //$roles=$this->roles()->get(); //esto gasta mas recurso get() se hace en los controladores en los modelos ya los tenemos aqui seria como coleccion ya no hace falta ()
        $roles=$this->roles; //cogemos todos los roles
            foreach ($roles as $suRole)//hago el bucle con los roles
            {
                if($suRole->nombre==$role)  // le voy preguntando si son iguales los roles
                    return true;
            }
            //si no es false
            return false;
    }


}
