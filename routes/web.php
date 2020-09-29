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

//Route::get('/', function () {//funcion q no tiene nombre se le dice anonima
   // return view('welcome');
//});

// Rutas invitados
//RUTA PRINCIPAL
/*
Route::get('/', 'WelcomeController@welcome')->name('welcome'); //esta ruta es la principal porqe la / quiere decir esto http://localhost/blogLaravel/public
//Route::get('/tema/{theme_id}','ThemeController@show'); // artículos de cada tema
Route::get('/tema/{tema}','ThemeController@show')->name('tema.show'); // artículos de cada tema
Route::get('/buscador','SearchController@index')->name('buscador.index'); // artículos de cada tema
Route::get('/comprobar-alias-js/{alias?}','auth\RegisterController@comprobarAlias');

// Rutas Usuarios Autenticados
Auth::routes(['verify' => true]);//Auth::routes()esto hace referencia a la autonticacion.. ['verify' => true] esto hace referencia a la verificacion de email

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');//le pongo este middleware para q solo puedan acceder a esta ruta si tal usuario fue verificado por el email
Route::put('/usuario-actualizar', 'UserController@update')->name('usuario.update');


//middleware: laravel tiene unos middleware por defectos en app/Htpp/Middleware.php ahi esta por ejemplo el de Authenticate q me redirecciona si no estoy autenticado
//auth es un alias para usar este middleware por ejemplo este alias se crea en app/Htpp/Kernel.php

//ADMINISTRADOR
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

//MODERADOR
Route::middleware(['auth','verified','role:moderador'])->group(function(){//con estos midelware y con el role le digo q solo los autenticados,los q fueron verificados por el email y los del rol de moderador pueden acceder a estas rutas
    //aca como es resource va tener mismos nombres q el otro resource entonces de esta forma cambio esos nombres
    //POR EJEMPLO 'index'  => 'moderador.articulos.index', index es el nombre en el controlador q hacen referencia a estos names 'moderador.articulos.index' q va ser el nuevo nombre
    Route::resource('moderador/articulos','moderador\ArticleController', ['names' => [
		'index'  => 'moderador.articulos.index',
	    'create' => 'moderador.articulos.create',
	    'store' => 'moderador.articulos.store',
	    'show' => 'moderador.articulos.show',
	    'edit' => 'moderador.articulos.edit',
	    'update' => 'moderador.articulos.update',
	    'destroy' => 'moderador.articulos.destroy',
    ]]);
    Route::get('moderador/imagenes/{imagen}','moderador\ArticleImageController@destroy')->name('moderador.imagen.delete');
    Route::get('moderador/buscador/articulos','moderador\SearchArticleController@index');
    });
*/
