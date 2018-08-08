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

Route::get('/access/tables/columns/{id?}', 'AccessController@columnsTableAccess')
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

Route::post('rols/update', 'RolController@updateRol')
	->name('rols.update');

Route::put('rols/archived', 'RolController@archivedRol')
	->name('rols.archived');

Route::get('rols/getPermission', 'RolController@getPermission')
	->name('rols.getPermission');

/* Rutas de User */
Route::get('user/{email}', 'UserController@getUserByEmail')
	//->where('email', '[A-Za-z]+')
	->name('user.get');

Route::get('user/by/{user_id}', 'UserController@selectUserById')
	->where('user_id', '[0-9]+')
	->name('user.by.id');

Route::get('users', 'userController@indexUser')
	->name('users');

Route::get('users/filter', 'UserController@indexFilterUser')
	->name('users.filter');

Route::post('users/create', 'UserController@storeUser')
	->name('users.store');

Route::post('users/update', 'UserController@updateUser')
	->name('users.update');

Route::put('users/archived', 'UserController@archivedUser')
	->name('users.archived');

Route::post('users/permits/create', 'UserController@storePermitsUser')
	->name('users.permits.store');

Route::put('users/permits/update', 'UserController@updatePermitsUser')
    ->name('users.permits.update');

Route::get('users/elements', 'userController@getElements')
    ->name('users.elements');

Route::get('users/getPermits', 'userController@getPermits')
	->name('users.getPermits');

/* Rutas de organizaciones */

Route::get('organizations', 'OrganizationController@indexOrganization')
	->name('organizations');

Route::get('organization/{id}', 'OrganizationController@selectOrganizationById')
	->name('organization');

Route::get('organizations/filter', 'OrganizationController@indexFilterOrganization')
	->name('organizations.filter');

Route::post('organizations/create', 'OrganizationController@storeOrganization')
	->name('organizations.store');

Route::put('organizations/update', 'OrganizationController@updateOrganization')
	->name('organizations.update');

Route::put('organizations/archived', 'OrganizationController@archivedOrganization')
	->name('organizations.archived');

Route::delete('organizations/delete/{id}', 'OrganizationController@deleteOrganization')
	->name('organizations.delete');

/* Rutas de Terceros */

Route::get('thirds', 'ThirdsController@indexThird')
	->name('thirds');

Route::get('thirds/combo-select', 'ThirdsController@comboSelect')
	->name('thirds.combo.select');

Route::get('third/{id}', 'ThirdsController@selectThirdById')
	->name('thirds.id');

Route::get('thirds/filter', 'ThirdsController@indexFilterThird')
	->name('thirds.filter');

Route::post('thirds/create', 'ThirdsController@storeThird')
	->name('thirds.store');

Route::put('thirds/update', 'ThirdsController@updateThird')
	->name('thirds.update');

Route::put('thirds/archived', 'ThirdsController@archivedThird')
	->name('thirds.archived');

Route::delete('thirds/delete/{third_id}/{location_id}', 'ThirdsController@deleteThird')
	->name('thirds.delete');

Route::get('thirds/contacts', 'ThirdsController@selectThirdContacts')
	->name('thirds.contacts');

Route::post('thirds/contact/create', 'ThirdsController@insertThirdContact')
	->name('thirds.contact.store');

Route::delete('thirds/contact/delete/{third_id}/{contact_id}', 'ThirdsController@DeleteThirdContact')
	->name('thirds.contact.delete');

/* Rutas de Contact */

Route::get('contact/{id}', 'ContactController@selectContactById')
	->name('contact');

Route::get('contacts/search', 'ContactController@searchContact')
	->name('contacts.search');

Route::put('contacts/update', 'ContactController@updateContact')
	->name('contacts.update');

Route::put('contacts/archived', 'ContactController@archivedContact')
	->name('contacts.archived');

/* Rutas de location */

Route::get('location/countries', 'LocationController@indexLocationCountry')
	->name('location.countries');

Route::get('location/states', 'LocationController@indexLocationState')
	->name('location.states');

Route::get('location/cities', 'LocationController@indexLocationCity')
	->name('location.cities');

/* Rutas de unidades */

Route::get('metering-units/', 'UnitController@indexUnit')
	->name('metering-units');

Route::post('metering-units/create', 'UnitController@createUnit')
	->name('metering-units.create');

Route::post('metering-units/update', 'UnitController@updateUnit')
	->name('metering-units.update');

Route::post('metering-units/archived', 'UnitController@archivedUnit')
	->name('metering-units.archived');

Route::post('metering-units/delete', 'UnitController@deleteUnit')
	->name('metering-units.delete');

/* Rutas de categorias */

Route::get('categories/', 'CategoryController@indexCategory')
	->name('categories');

Route::post('categories/create', 'CategoryController@createCategory')
	->name('categories.create');

Route::post('categories/update', 'CategoryController@updateCategory')
	->name('categories.update');

Route::post('categories/archived', 'CategoryController@archivedCategory')
	->name('categories.archived');

Route::post('categories/delete', 'CategoryController@deleteCategory')
	->name('categories.delete');

/* Rutas de condiciones */

Route::get('conditions/', 'ConditionController@indexCondition')
	->name('conditions');

Route::post('conditions/create', 'ConditionController@createCondition')
	->name('conditions.create');

Route::post('conditions/update', 'ConditionController@updateCondition')
	->name('conditions.update');

Route::post('conditions/delete', 'ConditionController@deleteCondition')
	->name('conditions.delete');

/* Rutas de tesoreria */

Route::get('warehouses/', 'WarehouseController@indexWarehouse')
	->name('warehouses');

Route::post('warehouses/create', 'WarehouseController@createWarehouse')
	->name('warehouses.create');

Route::put('warehouses/update', 'WarehouseController@updateWarehouse')
	->name('warehouses.update');

Route::delete('warehouses/delete/{id}', 'WarehouseController@deleteWarehouse')
	->name('warehouses.delete');

/* Rutas de fabricantes */

Route::get('manufacturers/', 'ManufacturerController@indexManufacturer')
	->name('manufacturers');

Route::post('manufacturers/create', 'ManufacturerController@createManufacturer')
	->name('manufacturers.create');

Route::put('manufacturers/update', 'ManufacturerController@updateManufacturer')
	->name('manufacturers.update');

Route::put('manufacturers/archived', 'ManufacturerController@archivedManufacturer')
	->name('manufacturers.archived');

Route::delete('manufacturers/delete', 'ManufacturerController@deleteManufacturer')
	->name('manufacturers.delete');

/* Rutas de lista de precios */

Route::get('price-lists/', 'PriceListController@indexPriceList')
	->name('price-lists');

Route::post('price-lists/create', 'PriceListController@createPriceList')
	->name('price-lists.create');

Route::put('price-lists/update', 'PriceListController@updatePriceList')
	->name('price-lists.update');

Route::delete('price-lists/delete', 'PriceListController@deletePriceList')
	->name('price-lists.delete');

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

/*  Rutas de ciudades  */

Route::get('cities', 'cityController@indexCity')
	->name('cities.index');

Route::get('cities/filter', 'cityController@indexFilterCity')
	->name('cities.filter');

Route::post('/cities/create', 'cityController@storeCity')
	->name('cities.create');

Route::put('/cities/update', 'cityController@updateCity')
	->name('cities.update');

Route::put('cities/archived', 'cityController@archivedCity')
	->name('cities.archived');

/*  Rutas de Custom Columns  */

Route::get('CustomColumns/getElementsView/{id?}', 'CustomColumnsController@getElementsView')
	->name('CustomColumns.getElementsView');

Route::post('/CustomColumns/create', 'CustomColumnsController@createCustomColumns')
	->name('CustomColumns.create');

Route::post('/CustomColumns/UpdateColumn', 'CustomColumnsController@updateCustomColumns')
	->name('CustomColumns.UpdateColumn');

Route::post('/CustomColumns/insertValue', 'CustomColumnsController@insertCustomColumnsValue')
	->name('CustomColumns.insertValue');

Route::post('/CustomColumns/deleteColumn', 'CustomColumnsController@deleteCustomColumns')
	->name('CustomColumns.deleteColumn');

Route::get('CustomColumns/getByTable/{id}', 'CustomColumnsController@getCustomColumnsByTable')
	->name('CustomColumns.getByTable');

Route::get('CustomColumns/getValuesBycolumnsAndContext/{id}', 'CustomColumnsController@getCustomColumnsValuesByIdColumn')
	->name('CustomColumns.getValuesBycolumnsAndContext');

/*  Rutas de field config  */

Route::get('fieldConfig/getfieldList/{id}', 'FieldConfigController@getfieldList')
	->name('fieldConfig.getfieldList');

Route::post('fieldConfig/UpdateConfiguration', 'FieldConfigController@UpdateConfiguration')
    ->name('fieldConfig.UpdateConfiguration');

/*  Rutas de migrations  */

Route::get('migration/clients', 'BananaMigrationsController@selectColumnsClients')
->name('migration.clients');

Route::post('migration/generate', 'BananaMigrationsController@generateMigration')
->name('migration.generate');

/*  Rutas de products  */

Route::get('products/getProductList', 'ProductController@getProductList')
	->name('products.getProductList');

Route::post('products/create', 'ProductController@storeProduct')
	->name('products.create');
