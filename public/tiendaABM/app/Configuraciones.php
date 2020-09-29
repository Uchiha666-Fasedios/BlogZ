<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
    protected $table = "configuraciones";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[
        'logo',	
        'titulo',
        'telefono',	
        'facebook',	
        'twitter',	
        'correo',	
        'direccion',	
        'horario',	
        'msm_procesado',	
        'msm_cancelado',
        'msm_entregado',	
        'banner_inicio_uno',	
        'banner_inicio_dos',	
        'banner_producto',	
        'paypal_mode',	
        'paypal_client_id',	
        'tipo_moneda',	
        'paypal_client_id_production'
    ];

    protected $guarded=[

    ];
}
