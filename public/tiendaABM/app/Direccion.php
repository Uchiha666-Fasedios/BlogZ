<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = "direccion";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'pais',	
        'region',
        'ciudad',
        'direccion',
        'zip'	
    ];

    protected $guarded=[

    ];
}
