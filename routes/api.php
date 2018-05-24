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

/* Rutas de Acceso */

Route::get('/access/rol/permits', 'AccessController@rolPermits')
	->name('access.rol.permits');

Route::get('/access/user/permits', 'AccessController@userPermits')
	->name('access.user.permits');

Route::get('/access/compare/permits', 'AccessController@comparePermits')
	->name('access.compare.permits');

/* Rutas de Rol */
Route::get('rols', 'RolController@indexRol')
	->name('rols');

Route::post('rols/create', 'RolController@storeRol')
	->name('rols.storeRol');

Route::post('rols/permits/create', 'RolController@storePermits')
	->name('rols.storeRol');