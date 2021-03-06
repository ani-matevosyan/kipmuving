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
Route::get('auth/facebook', 'Auth\FacebookController@redirectToProvider')
	->name('auth.facebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleProviderCallback');
Route::get('auth/gplus', 'Auth\GooglePlusController@redirectToProvider')
	->name('auth.google');
Route::get('auth/gplus/callback', 'Auth\GooglePlusController@handleProviderCallback');

Route::group(['prefix' => 'atacama'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/home/', 'HomeController@index');
	Route::get('/activities', 'ActivityController@index');
	Route::get('/agencies', 'AgencyController@index')->name('agencies');
	//TODO 
	Route::get('/guia', 'FreePagesController@index')->name('guide');
	Route::get('/guia/bicicleta', 'FreePagesController@getBicicleta')->name('guide-bicycle');
	Route::get('/guia/decarro', 'FreePagesController@getDecarro')->name('guide-car');
	Route::get('/guia/tourcultural', 'FreePagesController@getTourcultural')->name('guide-cultural');
});

Route::group(['prefix' => 'pucon'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/home/', 'HomeController@index');
	Route::get('/activities', 'ActivityController@index');
	Route::get('/agencies', 'AgencyController@index')->name('agencies');
	//TODO Change to free
	Route::get('/guia', 'FreePagesController@index')->name('guide');
	Route::get('/guia/bicicleta', 'FreePagesController@getBicicleta')->name('guide-bicycle');
	Route::get('/guia/decarro', 'FreePagesController@getDecarro')->name('guide-car');
	Route::get('/guia/tourcultural', 'FreePagesController@getTourcultural')->name('guide-cultural');
});

#Tests
Route::get('/tests/translations', 'HomeController@getTranslations');

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');
Route::post('/contact-us', 'HomeController@sendMessage');
Route::get('/entrance', 'HomeController@siteEntrance')->name('entrance');


#Service routes
Route::get('/locale/{code}', 'LocaleController@setLocale'); #Change locale
Route::get('/currency/{code}', 'CurrencyController@setCurrency'); #Change currency
Route::get('/city/{city}/{route?}', 'CityController@setCity'); #Change city


#Activities
Route::get('/activities', 'ActivityController@index')->name('activities');
Route::post('/activity/search', 'ActivityController@search');
Route::get('/activity/{id}', 'ActivityController@getActivity')
	->where('id', '[0-9]+');
Route::get('/activities/getsuprogram', 'ActivityController@getSuProgram');
Route::get('/activities/getselectedoffers', 'ActivityController@getSelectedOffers');
Route::get('/activities/getalloffers/{id}', 'ActivityController@getAllOffers');
Route::post('/activities/filters', 'ActivityController@filters');
Route::post('/activity/comment/add', 'ActivityController@addComment');
Route::get('updateActivitiesWidgetsPhotosData', 'ActivityController@updateActivitiesWidgetsPhotosData');
Route::get('updateActivitiesWidgetsPhotosData2', 'ActivityController@updateActivitiesWidgetsPhotosData');
Route::post('updateActivityWidgetsPhotosData', 'ActivityController@updateActivityWidgetsPhotosData');

#Offers
Route::post('/offer/date/set', 'OfferController@setDate');
Route::post('/offer/reserve', 'OfferController@reserve');
Route::post('/offer/remove', 'OfferController@remove');
Route::get('/offer/remove/{oid}', 'OfferController@removeFromBasket')
	->where('oid', '[0-9]+');
#Special offers
Route::post('/offer/special/add', 'SpecialOffersController@addToBasket');
Route::get('/offer/special/remove/{oid}', 'SpecialOffersController@removeFromBasket')
	->where('oid', '[0-9]+');
Route::post('/offer/special/remove', 'SpecialOffersController@removeFromBasketPost');
Route::get('/send-offer/{uid}', 'SpecialOffersController@sendOfferPage')
	->where('uid', '[a-zA-Z0-9]+');
Route::get('/send-offer', 'SpecialOffersController@sendOffer');
Route::get('/reserve/special-offer', 'ReservationController@reserveSpecialOffer');
Route::post('/offer/special/info', 'SpecialOffersController@getJsonInfo');
Route::get('/offer/special/confirm', 'SpecialOffersController@getConfirmOfferJsonData');
Route::post('/offer/special/confirm', 'ReservationController@reserveSpecialOffer');
Route::get('/offer/special/cancel/{id}', 'SpecialOffersController@unsubscribeOffer')
	->where('id', '[0-9a-z]+');
Route::post('/offer/addDays', 'OfferController@addDays');
Route::post('/offer/editDays', 'OfferController@editDays');
Route::post('/offer/getPriceByDateAndPersons', 'OfferController@getPriceByDateAndPersons');


#Agencies
Route::get('/agencies', 'AgencyController@index')->name('agencies');
Route::get('/agency/{id}', 'AgencyController@getAgency')
	->where('id', '[0-9]+');
Route::get('/agency-emails', [
	'middleware' => ['role:admin|developer'],
	'uses'       => '\App\Http\Controllers\AgencyEmailsController@viewList']);
Route::post('/agency-emails/send', [
	'middleware' => ['role:admin|developer'],
	'uses'       => '\App\Http\Controllers\AgencyEmailsController@sendEmails']);

#User
Route::get('/user/confirm/{confirmationCode}', 'UserController@confirmUser');
Route::get('/user/confirm/', 'UserController@getConfirmEmail');
Route::post('/user/confirm/', 'UserController@sendConfirmEmail');
Route::get('/user', 'UserController@getUser');
Route::get('/user/reservations', 'UserController@getUserReservations');
Route::post('/user/{id}/edit', 'UserController@updateUser')
	->where('id', '[0-9]+');
Route::post('/user/{id}/avatarupdate', 'UserController@updateUsersAvatar')
	->where('id', '[0-9]+');
Route::get('/user/getAvatar', 'UserController@getAvatar');


#Free pages activities
Route::get('/free/activity/add', 'FreePagesController@addActivity');

#Free pages
Route::get('/free', 'FreePagesController@index')
	->name('free');
Route::get('/free/bicicleta', 'FreePagesController@getBicicleta')
	->name('free-bicycle');
Route::get('/free/decarro', 'FreePagesController@getDecarro')
	->name('free-car');
Route::get('/free/tourcultural', 'FreePagesController@getTourcultural')
	->name('free-cultural');
Route::get('/free/getmappoints', 'FreePagesController@getMapPoints');

#Guide pages
Route::get('/guide', 'GuideController@howToGetToPucon')
	->name('guide-how-to-get-to-pucon');
Route::get('/guide/shops-and-services', 'GuideController@shopsAndServices')
	->name('guide-shops-and-services');
Route::get('/guide/transportation', 'GuideController@transportation')
	->name('guide-transportation');
Route::get('/guide/summer-and-winter', 'GuideController@summerAndWinter')
	->name('guide-summer-and-winter');
Route::get('/guide/where-to-sleep', 'GuideController@whereToSleep')
	->name('guide-where-to-sleep');
Route::get('/guide/night-life', 'GuideController@nightLife')
	->name('guide-night-life');
Route::get('/guide/city-and-region', 'GuideController@cityAndRegion')
	->name('guide-city-and-region');
Route::get('/guide/what-to-eat', 'GuideController@whatToEat')
	->name('guide-what-to-eat');
Route::get('/guide/money', 'GuideController@money')
	->name('guide-money');
Route::get('/guide/comment/add', 'GuideController@addComment');

#About
Route::get('/about', 'AboutController@index');
Route::get('/privacy-policy', 'AboutController@privacyPolicy');


#Calendar
Route::get('/calendar', 'CalendarController@index');
Route::get('/calendar/data', 'CalendarController@getData');
Route::post('calendar/process', 'CalendarController@getProcess');
Route::get('calendar/getICS', 'CalendarController@generateICS');


#Reservation
Route::get('/reserve', 'ReservationController@index');
Route::get('/bookit', 'ReservationController@reserve');
//Route::post('/reserve', 'ReservationController@reserve');
Route::get('/reservation/{id}/cancel', 'ReservationController@cancelReservation')
	->where('id', '[0-9]+');
Route::get('/reserve/paypal', 'ReservationController@paymentPaypal');
Route::get('/reserve/pagseguro', 'ReservationController@paymentPagseguro');
Route::get('/reserve/pagseguro/redirect', [
	'uses' => 'ReservationController@paymentPagseguroRedirectGet',
	'as'   => 'pagseguro.redirect.get'
]);
Route::post('/pagseguro/notification', [
	'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
	'as'   => 'pagseguro.notification',
]);
Route::post('/reservation/print', 'ReservationController@getPrintData');
Route::post('/reservation/cancelReservation/{id}', 'ReservationController@cancelReservation')
    ->where('id', '[0-9]+');

#Proposals
Route::post('/proposals/save', 'ProposalController@saveProposal');
Route::get('/proposal/{uid}', 'ProposalController@addFromLink');


//test
Route::get('/reserve/testemails/{type}', 'ReservationController@testEmails');


Route::get('/reserve/payu/redirect', 'ReservationController@paymentPayURedirect');
Route::post('/reserve/payu/notification', 'ReservationController@paymentPayUNotifications');
Route::get('/reserve/payu', 'ReservationController@paymentPayU');
//Route::get('/reserve/payu', 'ReservationController@getPayU');


Route::get('/routes/home', 'RoutesController@index')->name('routes.home');;
Route::get('/routes/filter', 'RoutesController@filterSuggestions');
Route::get('/routes/suggestions/{id}', 'RoutesController@suggestion')
	->name('suggestions-single')
	->where('id', '[0-9]+');
Route::get('/routes/activities/{id}', 'RoutesController@activity')
	->name('routes-single')
	->where('id', '[0-9]+');

# Admin Agency System
Route::get('/admin/agency', ['middleware' => ['role:admin|agencyAdmin|developer'],
    'uses'       => 'AdminAgency\ReservationsController@index']);

Route::get('/admin/agency/activities', [
    'middleware' => ['role:admin|agencyAdmin|developer'],
    'uses'       => 'AdminAgency\ActivityController@index',
    'as'         => 'adminAgency.activities'
]);
Route::post('/admin/agency/addActivity', 'AdminAgency\ActivityController@addActivity');
Route::post('/admin/agency/getActivity', 'AdminAgency\ActivityController@getActivity');
Route::post('/admin/agency/editActivity', 'AdminAgency\ActivityController@editActivity');
Route::post('/admin/agency/deleteActivity', 'AdminAgency\ActivityController@deleteActivity');

Route::get('/admin/agency/providers', [
    'middleware' => ['role:admin|agencyAdmin|developer'],
    'uses'       => 'AdminAgency\ProviderController@index',
    'as'         => 'adminAgency.providers'
]);
Route::post('/admin/agency/addProvider', 'AdminAgency\ProviderController@addProvider');
Route::post('/admin/agency/getProvider', 'AdminAgency\ProviderController@getProvider');
Route::post('/admin/agency/editProvider', 'AdminAgency\ProviderController@editProvider');
Route::post('/admin/agency/deleteProvider', 'AdminAgency\ProviderController@deleteProvider');
Route::post('/admin/agency/addProviderType', 'AdminAgency\ProviderController@addProviderType');
Route::post('/admin/agency/deleteProviderType', 'AdminAgency\ProviderController@deleteProviderType');