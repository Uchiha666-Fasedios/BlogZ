<?php  //ADMINISTRADOR
// Rutas Administrador ACA HAGO USO DEL middleware con las rutas de esta forma
//Route::middleware(['auth','admin'])->group(function(){//con esto le digo q solo los autenticados pueden acceder a estas rutas
Route::middleware(['auth','role:administrador'])->group(function(){//hago un so mas profecional con el middleware y se usa el ROLE en la explicacion de laravel se explica.. Resumiendo lo q hago es q solo accederan a estas rutas los autenticados y q tengan el rol de administrador
Route::get('admin/temas','admin\ThemeController@index')->name('temas.index');
Route::delete('admin/temas/{tema}','admin\ThemeController@destroy')->name('tema.delete');
Route::get('admin/temas/{tema}/edit','admin\ThemeController@edit')->name('tema.edit');
Route::put('admin/temas/{tema}','admin\ThemeController@update')->name('tema.update');
Route::get('admin/temas/create','admin\ThemeController@create')->name('tema.create');
Route::post('admin/temas','admin\ThemeController@store')->name('tema.store');


Route::resource('admin/articulos','admin\ArticleController');//con esta ruta de tipo resource resumo de poner varias rutas para el mismo controlador
//EXPLICACION: AL CREAR EN LA CONSOLA UN CONTROLADOR TIPO RESOURCE DE ESTA FORMA php artisan make:controller admin\ArticleController --resource --model=Article
//LO Q SE LOGRO ES ESTABLECER RUTAS PREDETERMINADAS PARA ESTE CONTROLADOR
//SE LAS PUEDE VER INVOCANDO ESTO.. php artisan route:list
Route::get('admin/imagenes/{imagen}','admin\ArticleImageController@destroy')->name('imagen.delete');
Route::get('admin/buscador/articulos','admin\SearchArticleController@index');


Route::get('admin/articulos-borrados','admin\ArticleDeleteController@index')->name('articulos-borrados.index');
	Route::put('admin/articulos-borrados/{articulo_id}','admin\ArticleDeleteController@restaurar')->name('articulos-borrados.restaurar');
	Route::delete('admin/articulos-borrados/{articulo_id}','admin\ArticleDeleteController@destroy')->name('articulos-borrados.destroy');
	Route::get('admin/articulos-borrados/{articulo_id}','admin\ArticleDeleteController@show')->name('articulos-borrados.show');


Route::resource('admin/usuarios','admin\UserController')->only(['index','edit','update']);//only con esto le aclaro las acciones q van a invocar a este controlador
Route::get('admin/buscador/usuarios','admin\SearchUserController@index');

Route::get('admin/correo-masivo','admin\CorreoMasivoController@index');
Route::post('admin/correo-masivo','admin\CorreoMasivoController@correoMasivo');

});
