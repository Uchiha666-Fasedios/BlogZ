<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancelacion extends Model
{
    protected $table = "cancelacion";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[
        'idventa',	
        'fecha',
        'estado',
        'motivo' 
    ];

    protected $guarded=[

    ];
}
