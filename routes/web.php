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

Route::get('/', 'CartasController@index')->name('cartas.index');
Route::get('/cartas/{id}', 'CartasController@show')->name('cartas.show');
Route::get('/getCardSpecificTypes/{id}', 'CartasController@getCardSpecificTypes');
Route::get('/getTypes/{id}', 'CartasController@getTypes');
