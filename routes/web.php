<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

#Activities
Route::get('/activities', 'ActivityController@index');
Route::get('/activity/{id}', 'ActivityController@getActivity')
	->where('id', '[0-9]+');

#Offers
Route::post('/offer/date/set', 'OfferController@setDate');
Route::post('/offer/reserve', 'OfferController@reserve');
Route::post('/offer/remove', 'OfferController@remove');

#Agencies
Route::get('/agencies', 'AgencyController@index');

#User
Route::get('/user/confirm/{confirmationCode}', 'UserController@confirmUser');
Route::get('/user/confirm/', 'UserController@getConfirmEmail');
Route::post('/user/confirm/', 'UserController@sendConfirmEmail');

#Guiae
Route::get('/guia', 'GuiaController@index');
Route::get('/guia/bicicleta', 'GuiaController@getBicicleta');
Route::get('/guia/decarro', 'GuiaController@getDecarro');
Route::get('/guia/tourcultural', 'GuiaController@getTourcultural');

#Locales
Route::get('/locale/{code}', 'LocaleController@setLocale');