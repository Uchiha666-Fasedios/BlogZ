<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,//unico q sea tipo email
        'email_verified_at' => now(), // le pongo la fecha de ahora
        // mio
        'alias' => $faker->unique()->word,//que sea unico y q sea una palabra
        'web' => $faker->safeEmailDomain,  //coloca tipo dominio
        'bloqueado' => $faker->boolean(false),
        'es_admin' => $faker->boolean(false),
        // mio
        /*'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',*/ // secret
        'password' => bcrypt('12345'),
        'remember_token' => Str::random(10),//10 digitos aleatorios
        'created_at' => $faker->dateTimeBetween('-3 years','now','America/Argentina/Buenos_Aires'), //crea una fecha -3 years desde hace 3 años, now hasta ahora
    ];
});
