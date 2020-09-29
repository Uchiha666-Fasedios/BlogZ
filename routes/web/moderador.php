<?php  //MODERADOR
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
