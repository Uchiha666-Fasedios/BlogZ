<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "producto";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[
        'titulo',	
        'resena',
        'contenido',	
        'idcategoria',
        'poster',
        'precio_ahora',
        'precio_antes',
        'estado',
        'stock',
        'slug',
        'num_ventas'
    ];

    protected $guarded=[

    ];
}
