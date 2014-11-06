<?php
header('Access-Control-Allow-Origin: *');
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
Route::post('upload',function(){
        $file            = Input::file('file');
        $destinationPath = public_path();
        $filename        = $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);



    return $uploadSuccess;

});
Route::get('/', function()
{
    $url = 'http://localhost:59135/api/pravniLica';
    $data = array('key1' => 'value1', 'key2' => 'value2');

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
});
Route::controller('config', 'ConfigController');
Route::controller('admin', 'UserManagementController');
Route::get('auth', 'Tappleby\AuthToken\AuthTokenController@index');
Route::post('auth', 'Tappleby\AuthToken\AuthTokenController@store');
Route::delete('auth', 'Tappleby\AuthToken\AuthTokenController@destroy');



Route::group(array('before'=>'auth.token|app'),function(){
    /**
     * Route resources
     */
    $excludedPaths=array('except' =>array('edit','create'));
    Route::resource('municipalities', 'MunicipalitiesController',$excludedPaths);
    Route::resource('settlements', 'SettlementsController',$excludedPaths);
    Route::resource('streets', 'StreetsController',$excludedPaths);

    Route::post('companies/add-bank','CompaniesController@addBank',$excludedPaths);
    Route::resource('companies', 'CompaniesController',$excludedPaths);
    Route::resource('orders', 'OrdersController',$excludedPaths);
    Route::resource('banks', 'BanksController',$excludedPaths);
    Route::resource('operators', 'OperatorsController',$excludedPaths);
    Route::resource('orders', 'OrdersController',$excludedPaths);
    Route::resource('sub_accounts', 'SubAccountsController',$excludedPaths);
    Route::resource('accounts', 'AccountsController',$excludedPaths);
    Route::resource('currencies', 'CurrenciesController',$excludedPaths);
    Route::resource('exchange_rates', 'ExchangeRatesController',$excludedPaths);
    Route::resource('ledgers', 'LedgersController',$excludedPaths);
    Route::resource('archive-ledgers', 'ArchiveLedgersController',$excludedPaths);
    Route::resource('tariffs', 'TariffsController',$excludedPaths);
    Route::resource('units', 'UnitsController',$excludedPaths);
    Route::resource('articles', 'ArticlesController',$excludedPaths);
    Route::resource('business_units', 'BusinessUnitsController',$excludedPaths);
    Route::resource('partners', 'PartnersController',$excludedPaths);
    Route::resource('calculation-headers', 'CalculationHeadersController',$excludedPaths);
    Route::resource('calculation_types', 'CalculationTypesController',$excludedPaths);
    Route::resource('calculation-details', 'CalculationDetailsController',$excludedPaths);
    Route::resource('archive-calculations', 'ArchiveCalculationsController');

    /**
     * Restful controllers
     */
    Route::controller('reports', 'ReportsController');
    Route::controller('reports-retail', 'ReportsRetailController');
});