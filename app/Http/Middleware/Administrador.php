<?php

namespace App\Http\Middleware;

use Closure;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->es_admin)//si esta autenticado y es_admin es true entro al if
        {
            return $next($request);//este se lanza cuando esta todo ok o sea te deja pasar o sea request lo q llega next pasa supongo esto es propio de laravel
        }

        return redirect('/');//si no me redirecciona
    }
}
