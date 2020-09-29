<?php

use Illuminate\Support\Facades\Route;

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

Route::get('adminlog', 'Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login','Auth\LoginController@login')->name('login');
Route::get('dashboard','DashboardController@index')->name('dashboard');

Route::get('admin/productos','ProductoController@index')->name('index.producto');
Route::get('admin/producto/registrar','ProductoController@create')->name('create.producto');
Route::post('admin/producto/registrar','ProductoController@store')->name('store.producto');
Route::post('admin/categoria/registrar','CategoriaController@store')->name('store.categoria');

Route::get('admin/producto/{slug}','ProductoController@edit')->name('edit.producto');
Route::patch('admin/producto/{slug}','ProductoController@update')->name('update.producto');

Route::delete('admin/producto/eliminar/{id}','ProductoController@destroy_producto')->name('productos.eliminar');
Route::patch('admin/producto/stock/{id}','ProductoController@aumentar_stock')->name('aumentar_stock.producto');
Route::get('admin/producto/galeria/{slug}','ProductoController@galeria')->name('galeria.producto');

Route::delete('admin/producto/galeria/foto/{id}','ProductoController@destroy_imagen')->name('destroy.galeria');
Route::post('admin/producto/galeria/{slug}','ProductoController@agregar_imagen')->name('agregar.galeria');

Route::get('admin/configuraciones','ConfigController@config')->name('config');
Route::patch('admin/configuraciones','ConfigController@config_save')->name('config_save');

Route::get('admin/ventas/cancelaciones','AdminController@cancelaciones')->name('cancelaciones');
Route::patch('admin/ventas/cancelaciones/{codigo}','AdminController@aplicar_reembolso')->name('cancelaciones.update');
Route::get('admin/ventas','AdminController@ventas')->name('ventas.admin');
Route::get('admin/venta/detalle/{codigo}','AdminController@detalle_venta')->name('detalle_venta.admin');
Route::patch('admin/venta/detalle/enviado/{id}','AdminController@aceptar_envio')->name('aceptar_envio.admin');
Route::patch('admin/venta/detalle/datos/{id}','AdminController@update_datos')->name('update_datos.admin');
Route::get('admin/mensajes','AdminController@mensajes')->name('mensajes');

/*USUARIOS---------------------------------*/
Route::get('sesion','InicioController@sesion_usuario')->name('login.user');
Route::get('','InicioController@index')->name('inicio');
Route::post('registro','InicioController@registro_rapido')->name('registro.rapido');
Route::get('cuenta/perfil','UsuarioController@index')->name('cuenta');
Route::patch('cuenta/perfil','UsuarioController@editar_perfil')->name('editar_perfil');
Route::get('cuenta/direcciones','UsuarioController@direccion')->name('direccion');
Route::post('cuenta/direcciones','UsuarioController@direccion_registro')->name('direccion_registro');
Route::post('cuenta/direccion/{id}','UsuarioController@direccion_eliminar')->name('direccion_eliminar');
Route::delete('cuenta/direccion/{id}','UsuarioController@direccion_eliminar')->name('direccion_eliminar');

Route::get('productos','InicioController@productos')->name('productos');

Route::get('productos/categoria/{categoria}','InicioController@productos_by_cat')->name('productos.categoria');
Route::get('producto/{slug}','InicioController@producto_detalle')->name('producto');
Route::post('producto/carrito','UsuarioController@agregar_carrito')->name('agregar.carrito');
Route::delete('producto/carrito/suprimir/{id}','UsuarioController@quitar_del_carrito')->name('quitar.carrito');

Route::get('cuenta/carrito','UsuarioController@carrito')->name('carrito');
Route::get('carrito/checkout/detalles/','UsuarioController@carrito')->name('carrito');
Route::get('venta/checkout/detalles/{codigo}/{transaccion}/{productos}/{cantidades}/{direccion}/{total}/{currency}/{metodo}','UsuarioController@checkout')->name('checkout');
Route::get('cuenta/compras/historial','UsuarioController@mis_compras')->name('mis_compras');
Route::get('cuenta/compras/producto/{codigo}','UsuarioController@detalle_compra')->name('detalleventa');
Route::patch('cuenta/compra/confirmar/{id}','UsuarioController@confirmar_entraga')->name('confirmar_entraga');
Route::post('cuenta/compra/resena','UsuarioController@emitir_resena')->name('emitir_resena');
Route::post('cuenta/compras/historial','UsuarioController@cancelacion')->name('cancelacion');

Route::get('contacto','InicioController@contacto')->name('contacto');
Route::post('contacto','InicioController@contacto_send')->name('contacto.send');
Route::get('lo-mas-vendido','InicioController@best_seller')->name('best_seller');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
