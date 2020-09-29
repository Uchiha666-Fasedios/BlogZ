<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $role)//si lo q me llega de role..con esto $role de parametro
    {
        if (!$request->user()->hasRole($role)) { //$request->user() si el usuario q intenta acceder a dicha ruta ..hasRole tiene como rol..$role SI ES DIFERENTE A ESTO ENTRO AL IF
            abort(403, "No tienes autorización para ingresar.");//abort saca un error
        }
//si no
        return $next($request);//me deja pasar
    }
}
