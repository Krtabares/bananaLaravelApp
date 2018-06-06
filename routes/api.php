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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* Rutas de Acceso */

Route::post('login', 'LoginController@login')
	->name('login');

Route::get('/access/tables/columns', 'AccessController@columnsTableAccess')
	->name('access.tables.columns');

Route::get('/access/user/tables', 'AccessController@userTableAccess')
	->name('access.user.tables');

Route::get('/access/rol/permits', 'AccessController@rolPermitsAccess')
	->name('access.rol.permits');

Route::get('/access/user/permits', 'AccessController@userPermitsAccess')
	->name('access.user.permits');

Route::get('/access/total/permits', 'AccessController@totalAccess')
	->name('access.total.permits');

/* Rutas de Rol */
Route::get('rols', 'RolController@indexRol')
	->name('rols');

Route::get('rol/{id}', 'RolController@selectRolById')
	->name('rol');

Route::get('rols/filter', 'RolController@indexFilterRol')
	->name('rols.filter');

Route::post('rols/create', 'RolController@storeRol')
	->name('rols.store');

Route::put('rols/update', 'RolController@updateRol')
	->name('rols.update');

Route::put('rols/archived', 'RolController@archivedRol')
	->name('rols.archived');

/* Rutas de User */
Route::get('user/{email}', 'UserController@getUserByEmail')
	//->where('email', '[A-Za-z]+')
	->name('user.get');

Route::get('users', 'userController@indexUser')
	->name('users');

Route::get('users/filter', 'UserController@indexFilterUser')
	->name('users.filter');

Route::post('users/create', 'UserController@storeUser')
	->name('users.store');

Route::put('users/update', 'UserController@updateUser')
	->name('users.update');

Route::put('users/archived', 'UserController@archivedUser')
	->name('users.archived');

Route::post('users/permits/create', 'UserController@storePermitsUser')
	->name('users.permits.store');

Route::put('users/permits/update', 'UserController@updatePermitsUser')
	->name('users.permits.update');

/*  Rutas de paises  */

Route::get('/countries', 'CountryController@indexCountry')
	->name('countries');

Route::get('countries/filter', 'CountryController@indexFilterCountry')
	->name('countries.filter');

Route::post('/countries/create', 'CountryController@storeCountry')
	->name('countries.create');

Route::put('/countries/update', 'CountryController@updateCountry')
	->name('countries.update');

Route::put('countries/archived', 'CountryController@archivedCountry')
	->name('countries.archived');

/*  Rutas de estados  */

Route::get('states', 'StateController@indexState')
	->name('states.index');

Route::get('states/filter', 'StateController@indexFilterState')
	->name('states.filter');

Route::post('/states/create', 'StateController@storeState')
	->name('states.create');

Route::put('/states/update', 'StateController@updateState')
	->name('states.update');

Route::put('states/archived', 'StateController@archivedState')
	->name('states.archived');