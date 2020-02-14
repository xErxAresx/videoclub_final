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

Route::put('/catalog/rent/{id}','CatalogController@putRent')->middleware('auth');
Route::put('/catalog/return/{id}','CatalogController@putReturn')->middleware('auth');
Route::put('/catalog/delete/{id}','CatalogController@deleteMovie')->middleware('auth');
Route::get('/', 'HomeController@getHome');
Route::get('/catalog', 'CatalogController@getIndex')->middleware('auth');
Route::get('/catalog/show/{id}', 'CatalogController@getShow')->middleware('auth');
Route::get('/catalog/create', 'CatalogController@getCreate')->middleware('auth');
Route::post('/catalog/create', 'CatalogController@postCreate')->middleware('auth');
Route::post('/catalog/edit/{id}', 'CatalogController@putEdit')->middleware('auth');
Route::put('/catalog/edit/{id}', 'CatalogController@putEdit')->middleware('auth');
Route::get('/catalog/edit/{id}', 'CatalogController@getEdit')->middleware('auth');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('catalog/show/{id}', 'CatalogController@postCreateR')->middleware('auth');

//Category
Route::resource('categories','CategoryController');
Route::get('/categories', 'CategoryController@index')->middleware('auth');
Route::get('/categories/create', 'CategoryController@create')->middleware('auth');
Route::post('/categories/create', 'CategoryController@createP')->middleware('auth');
Route::get('/categories/{id}', 'CategoryController@show')->middleware('auth');
Route::get('/categories/{id}/edit', 'CategoryController@edit')->middleware('auth');
Route::put('/categories/{id}/edit', 'CategoryController@editP')->middleware('auth');
Route::delete('/categories/{id}', 'CategoryController@destroy')->middleware('auth');

//Buscador
Route::get('/catalog/buscar', 'CatalogController@buscar')->middleware('auth');

//Mejores pelis
Route::get('/catalog/rates','CatalogController@rates')->middleware('auth');