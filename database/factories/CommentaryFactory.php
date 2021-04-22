<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Commentary;
use Faker\Generator as Faker;

$factory->define(Commentary::class, function (Faker $faker) {
    return [
        'comentario' => $faker->text(100), // 1000  va tener un texto de 100 letras
		'user_id' => $faker->numberBetween(1,10),//entre 1 y 10
    ];
});
