<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\ArticleImage;
use App\Commentary;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles=factory(Article::class,50)->create();//coloco esto para crear 50 articulos ficticios
        $articles->each(function($article){ //each interactua con colecciones
    	$images=factory(ArticleImage::class,3)->make();//un articulo va crear tres imagenes
    	// Creamos 10 comentarios por cada artículo (500 comentarios en total)
        $commentaries=factory(Commentary::class,10)->make();
        $article->images()->saveMany($images);
    });
    }
}
