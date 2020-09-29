<?php

//NO FUNCIONO ESTO
namespace App;
use Jenssegers\Date\Date;//esto lo saqe de la pagina de traducciones hay q ponerlo importar esto q se cargo en vendor por composer (lanzando un comando en la consola)

//un trait permitíra reutilizar código entre distintas clases sin recurrir a la herencia.
trait TraductorFechas
{
	public function getCreatedAtAttribute($date)
	{
		return new Date($date);
	}
    public function getDeletedAtAttribute($fecha)
	{
		return new Date($fecha);
	}

}
