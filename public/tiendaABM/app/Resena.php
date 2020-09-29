<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $table = "resena";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'resena',	
        'iduser',
        'createAt',
        'idproducto',	
        'foto_uno',
        'foto_dos',
        'foto_tres',
    ];

    protected $guarded=[

    ];
}
