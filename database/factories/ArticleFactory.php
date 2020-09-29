<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'titulo' => $faker->sentence(5,true), //una frase de 5 palabras true para q pueda ser 1 2 3 o 4
		'contenido' => $faker->text(300),
		'activo' => $faker->boolean(true),  //q este en true por defecto
		'theme_id' => $faker->numberBetween(1,5), //temas entre 1 a 5 porqe hay 5 temas creados obvio
		'user_id' => $faker->numberBetween(1,10),  //usuarios entre 1 a 10 porqe ay 10 usuarios
    ];
});
