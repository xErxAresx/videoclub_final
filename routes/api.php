<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/catalog', 'APICatalogCOntroller@index');
Route::get('/catalog/{id}', 'APICatalogCOntroller@show');
Route::post('/catalog', 'APICatalogCOntroller@store')->middleware('auth.basic.once');
Route::put('/catalog/{id}', 'APICatalogCOntroller@update')->middleware('auth.basic.once');
Route::delete('/catalog/{id}', 'APICatalogCOntroller@destroy')->middleware('auth.basic.once');
Route::put('/catalog/{id}/rent', 'APICatalogCOntroller@putRent')->middleware('auth.basic.once');;
Route::put('/catalog/{id}/return', 'APICatalogCOntroller@putReturn')->middleware('auth.basic.once');
