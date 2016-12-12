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
Route::post('/contact-us', 'HomeController@sendMessage');

#Activities
Route::get('/activities', 'ActivityController@index');
Route::post('/activity/search', 'ActivityController@search');
Route::get('/activity/{id}', 'ActivityController@getActivity')
	->where('id', '[0-9]+');
Route::get('/activities/getsuprogram', 'ActivityController@getSuProgram');
Route::get('/activities/getselectedoffers', 'ActivityController@getSelectedOffers');

#Offers
Route::post('/offer/date/set', 'OfferController@setDate');
Route::post('/offer/reserve', 'OfferController@reserve');
Route::post('/offer/remove', 'OfferController@remove');

#Agencies
Route::get('/agencies', 'AgencyController@index');
Route::get('/agency/{id}', 'AgencyController@getAgency')
	->where('id', '[0-9]+');

#Calendar
Route::get('/calendar', 'CalendarController@index');
Route::get('/calendar/data', 'CalendarController@getData');

#Reservation
Route::get('/reserve', 'ReservationController@index');
Route::post('/reserve', 'ReservationController@reserve');

#User
Route::get('/user/confirm/{confirmationCode}', 'UserController@confirmUser');
Route::get('/user/confirm/', 'UserController@getConfirmEmail');
Route::post('/user/confirm/', 'UserController@sendConfirmEmail');
Route::get('/user/{id}', 'UserController@getUser')
	->where('id', '[0-9]+');
Route::post('/user/{id}/edit', 'UserController@updateUser')
	->where('id', '[0-9]+');

#Guiae
Route::get('/guia', 'GuiaController@index');
Route::get('/guia/bicicleta', 'GuiaController@getBicicleta');
Route::get('/guia/decarro', 'GuiaController@getDecarro');
Route::get('/guia/tourcultural', 'GuiaController@getTourcultural');

#Locales
Route::get('/locale/{code}', 'LocaleController@setLocale');