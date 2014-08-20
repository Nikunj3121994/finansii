<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{

	return "asd";

});
Route::controller('config', 'ConfigController');
Route::get('auth', 'Tappleby\AuthToken\AuthTokenController@index');
Route::post('auth', 'Tappleby\AuthToken\AuthTokenController@store');
Route::delete('auth', 'Tappleby\AuthToken\AuthTokenController@destroy');



/**
 * Route resources
 */
Route::resource('municipalities', 'MunicipalitiesController',array('except' =>array('edit','create')));
Route::resource('settlements', 'SettlementsController');
Route::resource('streets', 'StreetsController');

Route::post('companies/add-bank','CompaniesController@addBank');
Route::resource('companies', 'CompaniesController');
Route::resource('orders', 'OrdersController');
Route::resource('banks', 'BanksController');
Route::resource('operators', 'OperatorsController');
Route::resource('orders', 'OrdersController');
Route::resource('sub-accounts', 'SubAccountsController');
Route::resource('accounts', 'AccountsController');