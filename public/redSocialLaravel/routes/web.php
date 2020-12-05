<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Image;


Route::get('/', function () {/*

//como Image es un ORM no hace falta instanciar con new

	$images = Image::all();//all()ya es propia del ORM y nos trae todo la q hay en images
	foreach($images as $image){
		echo $image->image_path."<br/>";
		echo $image->description."<br/>";
		echo $image->user->name.' '.$image->user->surname.'<br/>';//tambien podemos traer de este objeto image todo lo q hay en las otras clases por haber echo las relaciones

		if(count($image->comments) >= 1){//el metodo comments fue convertido en propiedad por usar ORM entonces es mas sencillo llamarlo
			echo '<h4>Comentarios</h4>';
			foreach($image->comments as $comment){
				echo $comment->user->name.' '.$comment->user->surname.': ';//tambien el objeto comment tiene relacion con la clase user
				echo $comment->content.'<br/>';
			}
		}

		echo 'LIKES: '.count($image->likes);
		echo "<hr/>";
	}

	die();*/

    return view('welcome');
});
//EL HEADER ESTA EN RESOURCES/VIEWS/LAYOUTS/APP.BLADE.PHP

// GENERALES
Auth::routes();//rutas especiales q ya vienen hechas se genero por poner en artisan el comando de autenticacion php artisan make:auth para la autenticacion
Route::get('/', 'HomeController@index')->name('home');//le borre home y deje la barra sola para q vaya al login tambien lo hice en app/http/auth/RegisterController para q despues de registrar vaya al login

// USUARIO
Route::get('/configuracion', 'UserController@config')->name('config');//name('config') ES EL NOMBRE DE LA RUTA PARA INVOCAR LA RUTA DE CUALQUIER LADO, '/configuracion' ES COMO SE VA A VER EN LA URL
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');//?el parametro es opcional

// IMAGEN
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

// COMENTARIO
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

// LIKE
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes', 'LikeController@index')->name('likes');
