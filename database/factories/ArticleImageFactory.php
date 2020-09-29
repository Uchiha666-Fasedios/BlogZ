<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArticleImage;
use Faker\Generator as Faker;



$factory->define(ArticleImage::class, function (Faker $faker) {
    return [
        'nombre'=>\Faker\Provider\Image::image(storage_path().'/app/public/imagenesArticulos',250 , 250, 'animals',false), //esto lo q hace es me mete imagenes 250x250 en la tabla article_images en el campo nombre y en app/public/imagenesArticulos. las coge de http://lorempixel.com/ animals es de animales en la pagina podes fijarte y eligir..false para q me guarde solo el nombre de la imagen si pongo true me guarda la ruta
        //'nombre'=>\Mmo\Faker\PicsumProvider::picsum(storage_path().'/app/public/imagenesArticulos', 400, 400, false),
        'article_id'=>$faker->numberBetween(1,50), //como vamos a crear 50 imagenes ponemos entre 1 y 50
    ];
});
