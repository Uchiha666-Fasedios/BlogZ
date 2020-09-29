<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    //LE DOY DE ALTA A LOS POLICIAS ya no hace falta este paso en laravel 7
    protected $policies = [
        // 'App\Article' => 'App\Policies\ArticlePolicy',
         //'App\ArticleImage' => 'App\Policies\ArticleImagePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
