<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = "users";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'name',	
        'fullname',	
        'name',
        'password',
        'role',
        'telefono',
        'tipo_doc',
        'num_doc'
    ];

    protected $guarded=[

    ];
}
