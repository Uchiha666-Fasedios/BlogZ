<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categoria";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[
        'titulo',	
        'icono'
    ];

    protected $guarded=[

    ];
}
