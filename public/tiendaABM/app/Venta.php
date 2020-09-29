<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "venta";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'codigo',	
        'transaccion',
        'iduser',	
        'idproducto',
        'iddireccion',
        'cantidad',
        'createAt',
        'iddireccion',
        'track',
        'tiempo',
        'medio_postal',
        'postal',
        'total',
        'metodo'
    ];

    protected $guarded=[

    ];
}
