<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //muchos a muchos
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();//->withTimestamps() esto es para q se llenen las fechas automaticamente en la tabla pibote role_user cuando hago el php artisan migrate:refresh --seed
    }
}
