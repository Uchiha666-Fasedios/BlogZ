<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Theme;
use App\Article;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users=factory(User::class,10)->create();
        $users->each(function ($user) {//se crean los usuarios con el rol 1
            $user->roles()->sync(1);//medida se van creando los usuarios se le pone role_id en 1
        });
        //factory(User::class)->create();//coloco esto para crear el usuario ficticio
/*
esto se hizo para crear 10 usuarios y por cada usuario un thema y 5 articulos PERO ES UNA MANERA MAS COMPLEJA Y TUVE Q COMENTAR EN DATABASESEEDER LO DE ARTICULOS Y TEMA
            $users=factory(User::class,10)->create();//coloco esto para crear 10 usuarios ficticios
            $users->each(function($user){
        	$themes=factory(Theme::class,1)->make();
        	$user->themes()->saveMany($themes);

        	$themes->each(function($theme){
        		$articles=factory(Article::class,5)->make();
        		$theme->articles()->saveMany($articles);
        	});
        	});*/
    }
}
