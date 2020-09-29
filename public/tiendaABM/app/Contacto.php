<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = "mensajes";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[
        'nombres',	
        'correo',
        'mensaje',
        'telefono'
    ];

    protected $guarded=[

    ];
}
