<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Theme;
use Faker\Generator as Faker;

$factory->define(Theme::class, function (Faker $faker) {
    $nombre=$faker->unique()->word;//pongo aca nombre para q el nombre y el slug coincidan porqe los quiero con el mismo nombre unique()->word que sea una palabra y unico
    return [
        //'user_id' => $faker->numberBetween(1,10),// q sea un numero del 1 al 10 hago esto porqe se crearon 10 usuarios
        'user_id' => 1,  //solo el usuario con id 1
        'nombre' => ucfirst($nombre),//ucfirst q sea en mayuscula la primer letra
		'slug' => $nombre,
		'destacado' => $faker->boolean(false),
		'suscripcion' => $faker->boolean(false),
    ];
});
