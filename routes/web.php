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

/* Rutas de acceso */

Route::get('/access/rol/permits', 'AccessController@rolPermits')
	->name('access.rol.permits');

Route::get('/access/user/permits', 'AccessController@userPermits')
	->name('access.user.permits');

Route::get('/access/compare/permits', 'AccessController@comparePermits')
	->name('access.compare.permits');

Route::get('/', function () {
    return view('contenido.contenido');
})->name('contenido');

/*  Rutas de paises  */

Route::get('/countries', 'CountryController@index')
	->name('countries');

Route::post('/countries/new', 'CountryController@store')
	->name('countries.new');

Route::put('/countries/update', 'CountryController@update')
	->name('countries.update');

Route::put('countries/archived', 'CountryController@archived')
	->name('countries.archived');

Route::put('countries/desarchived', 'CountryController@desarchived')
	->name('countries.desarchived');

Route::delete('/countries/destroy', 'CountryController@destroy')
	->name('countries.delete');

/*  Rutas de estados  */

Route::get('states', 'StateController@index')
	->name('states.index');

Route::get('/states/list/countries', 'StateController@listCountries')
	->name('states.list_countries');

Route::post('/states/new', 'StateController@store')
	->name('states.new');

Route::put('/states/update', 'StateController@update')
	->name('states.update');

Route::put('states/archived', 'StateController@archived')
	->name('states.archived');

Route::put('states/desarchived', 'StateController@desarchived')
	->name('states.desarchived');

Route::delete('/states/destroy', 'StateController@destroy')
	->name('states.delete');

/*  Rutas de ciudades  */

Route::get('cities', 'CityController@index')
	->name('cities.index');

Route::get('/cities/list/countries', 'CityController@listCountries')
	->name('cities.list_countries');

Route::get('/cities/list/states', 'CityController@listStates')
	->name('cities.list_states');

Route::post('/cities/new', 'CityController@store')
	->name('cities.new');

Route::put('/cities/update', 'CityController@update')
	->name('cities.update');

Route::put('cities/archived', 'CityController@archived')
	->name('cities.archived');

Route::put('cities/desarchived', 'CityController@desarchived')
	->name('cities.desarchived');

Route::delete('/cities/destroy', 'CityController@destroy')
	->name('cities.delete');

/*  Rutas de unidades  */

Route::get('units', 'UnitController@index')
	->name('units');

Route::post('/units/new', 'UnitController@store')
	->name('units.new');

Route::put('/units/update', 'UnitController@update')
	->name('units.update');

Route::put('units/archived', 'UnitController@archived')
	->name('units.archived');

Route::put('units/desarchived', 'UnitController@desarchived')
	->name('units.desarchived');

Route::delete('/units/destroy', 'UnitController@destroy')
	->name('units.delete');

/*  Rutas de categorias  */

Route::get('categories', 'CategoryController@index')
	->name('categories');

Route::get('/categories/list/parents', 'CategoryController@listParents')
	->name('categories.list_parents');

Route::post('/categories/new', 'CategoryController@store')
	->name('categories.new');

Route::put('/categories/update', 'CategoryController@update')
	->name('categories.update');

Route::put('categories/archived', 'CategoryController@archived')
	->name('categories.archived');

Route::put('categories/desarchived', 'CategoryController@desarchived')
	->name('categories.desarchived');

Route::delete('/categories/destroy', 'CategoryController@destroy')
	->name('categories.delete');

/*  Rutas  de terminos de pagos  */

Route::get('payment-term', 'PaymentTermController@index')
	->name('payment-term');

Route::post('/payment-term/new', 'PaymentTermController@store')
	->name('payment-term.new');

Route::put('/payment-term/update', 'PaymentTermController@update')
	->name('payment-term.update');

Route::put('payment-term/archived', 'PaymentTermController@archived')
	->name('payment-term.archived');

Route::put('payment-term/desarchived', 'PaymentTermController@desarchived')
	->name('payment-term.desarchived');

Route::delete('/payment-term/destroy', 'PaymentTermController@destroy')
	->name('payment-term.delete');

/*  Rutas  de tipos de terminos  */

Route::get('term-type', 'TermTypeController@index')
	->name('term-type');

Route::post('/term-type/new', 'TermTypeController@store')
	->name('term-type.new');

Route::put('/term-type/update', 'TermTypeController@update')
	->name('term-type.update');

Route::put('term-type/archived', 'TermTypeController@archived')
	->name('term-type.archived');

Route::put('term-type/desarchived', 'TermTypeController@desarchived')
	->name('term-type.desarchived');

Route::delete('/term-type/destroy', 'TermTypeController@destroy')
	->name('term-type.delete');