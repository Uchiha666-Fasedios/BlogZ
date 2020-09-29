<?php  // Rutas Usuarios Autenticados
Auth::routes(['verify' => true]);//Auth::routes()esto hace referencia a la autonticacion.. ['verify' => true] esto hace referencia a la verificacion de email

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');//le pongo este middleware para q solo puedan acceder a esta ruta si tal usuario fue verificado por el email
Route::put('/usuario-actualizar', 'UserController@update')->name('usuario.update');
//middleware: laravel tiene unos middleware por defectos en app/Htpp/Middleware.php ahi esta por ejemplo el de Authenticate q me redirecciona si no estoy autenticado
//auth es un alias para usar este middleware por ejemplo este alias se crea en app/Htpp/Kernel.php
