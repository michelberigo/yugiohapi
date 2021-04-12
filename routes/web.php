<?php

Route::get('/', 'CartasController@index')->name('cartas.index');
Route::get('/cartas/{id}', 'CartasController@show')->name('cartas.show');
Route::get('/getCardSpecificTypes/{id}', 'CartasController@getCardSpecificTypes');
Route::get('/getTypes/{id}', 'CartasController@getTypes');
