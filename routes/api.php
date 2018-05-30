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
	->name('access.tables');

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

Route::get('rols/filter', 'RolController@indexFilterRol')
	->name('rols.filterRol');

Route::post('rols/create', 'RolController@storeRol')
	->name('rols.storeRol');

Route::put('rols/update', 'RolController@updateRol')
	->name('rols.updateRol');

Route::put('rols/archived', 'RolController@archivedRol')
	->name('rols.archivedRol');

/* Rutas de User */
Route::get('user/{email}', 'UserController@getUserByEmail')
	//->where('email', '[A-Za-z]+')
	->name('user.get');

Route::get('users', 'userController@indexUser')
	->name('users');