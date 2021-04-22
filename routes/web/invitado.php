<?php  // Rutas invitados
//RUTA PRINCIPAL
Route::get('/', 'WelcomeController@welcome')->name('welcome'); //esta ruta es la principal porqe la / quiere decir esto http://localhost/blogLaravel/public
//Route::get('/tema/{theme_id}','ThemeController@show'); // artículos de cada tema
Route::get('/tema/{tema}','ThemeController@show')->name('tema.show'); // artículos de cada tema
Route::get('/buscador','SearchController@index')->name('buscador.index'); // artículos de cada tema
Route::get('/sobremi', 'WelcomeController@sobremi')->name('sobremi');
Route::get('/contacto', 'WelcomeController@contacto')->name('contacto');
// Rutas invitados axios
Route::get('/comprobar-alias-js/{alias?}','auth\RegisterController@comprobarAlias');//? es q viene algo por defecto para q no de error cuando este vacio por si el usuario no pone nada
Route::get('/buscador-predictivo','SearchController@buscadorPredictivo');