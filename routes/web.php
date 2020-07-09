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

Route::get('/', 'TestController@welcome');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}','ProductController@show'); // Trae el formulario para nuevos productos

Route::get('/categories/{category}','CategoryController@show'); // Trae el formulario para nuevos productos


Route::post('/cart', 'CartDetailController@store'); // Graba los productos seleccionados para el carrito
Route::delete('/cart', 'CartDetailController@destroy'); // borra los productos del carrito
Route::post('order', 'CartController@update'); // Graba los productos seleccionados para el carrito


Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {
	Route::get('/products', 'ProductController@index'); // Listado de productos
	Route::get('/products/create', 'ProductController@create'); // Trae el formulario para nuevos productos
	Route::post('/products', 'ProductController@store'); // Graba los productos creados
	Route::get('/products/{id}/edit', 'ProductController@edit'); // Trae el formulario para su edicion
	Route::post('/products/{id}/edit', 'ProductController@update'); // actualiza el producto editado
	Route::delete('/products/{id}', 'ProductController@destroy'); // borra productos

	Route::get('/products/{id}/images', 'ImageController@index'); // Lista imagenes
	Route::post('/products/{id}/images', 'ImageController@store'); // Graba imagenes
	Route::delete('/products/{id}/images', 'ImageController@destroy'); // Borra imagenes
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); // Lista imagenes

	Route::get('categories', 'CategoryController@index'); // Listado de Categoryos
	Route::get('/categories/create', 'CategoryController@create'); // Trae el formulario para nuevos Categoryos
	Route::post('/categories', 'CategoryController@store'); // Graba los Categoryos creados
	Route::get('/categories/{category}/edit', 'CategoryController@edit'); // Trae el formulario para su edicion
	Route::post('/categories/{category}/edit', 'CategoryController@update'); // actualiza el Categoryo editado
	Route::delete('/categories/{category}', 'CategoryController@destroy'); // borra productos

});

