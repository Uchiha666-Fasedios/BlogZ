<?php

namespace App\Providers;

use App\Theme;//traigo el modelo
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;//esta la puse pero me funciona sin esto tambien

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function boot()
    {
        Schema::defaultStringLength(190);
//SE ESTA CREANDO UN VIEW COMPOSER
        view()->composer(['layouts.app','admin.articulos.create','admin.articulos.edit','moderador.articulos.edit'], function ($view) { //le estamos pasando esta temasTodos variable a la vista layouts.app y a admin.articulos.create y admin.articulos.edit si qeremos para todas *
           $temasTodos=Theme::all();
           $view->with(compact('temasTodos'));
        });
    }


    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
}
