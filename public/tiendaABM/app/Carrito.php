<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = "carrito";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[
        'iduser',	
        'idproducto',
        'createAt',
        'cantidad'
    ];

    protected $guarded=[

    ];
}
