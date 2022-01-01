<?php

use Illuminate\Support\Facades\Route;

//----------------------------auth----------------------------------
Route::get('/', function () {return view('bizland');});
Auth::routes();
//Auth::routes(['register' => false]);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
//-------------------------------ajax---------------------------
Route::get('ajax/get-batch-by-vessel/{vessel_id}', 'AjaxController@getBatchByVessel')->name('ajax/get-batch-by-vessel');
Route::get('ajax/get-port-by-country/{country_id}', 'AjaxController@getPortByCountry')->name('ajax/get-port-by-county');
Route::get('ajax/get-next-port/{vessel_id}/{curr_port_id}', 'AjaxController@getNextPort')->name('ajax/get-next-port');
//-----------------------------admin settings-----------------------------
Route::post('admin-continents/data', 'ContinentsController@data')->name('admin-continents.data');
Route::resource('admin-continents', 'ContinentsController');

Route::post('admin-countries/data', 'CountryController@data')->name('admin-countries.data');
Route::resource('admin-countries', 'CountryController');

Route::post('admin-cities/data', 'CityController@data')->name('admin-cities.data');
Route::resource('admin-cities', 'CityController');

Route::post('admin-offices/data', 'OfficeController@data')->name('admin-offices.data');
Route::resource('admin-offices', 'OfficeController');

Route::post('admin-units/data', 'UnitController@data')->name('admin-units.data');
Route::resource('admin-units', 'UnitController');

Route::post('admin-vessels/data', 'VesselController@data')->name('admin-vessels.data');
Route::resource('admin-vessels', 'VesselController');

Route::post('admin-batches/data', 'BatchController@data')->name('admin-batches.data');
Route::resource('admin-batches', 'BatchController');

Route::get('admin-vessel-routes/data', 'VesselRouteController@data')->name('admin-vessel-routes.data');
Route::post('admin-vessel-routes/data', 'VesselRouteController@data')->name('admin-vessel-routes.data');
Route::resource('admin-vessel-routes', 'VesselRouteController');
//-----------------------Trackings------------------------------------------
Route::post('admin-trackings/incoming-data/{port_id?}', 'TrackingController@inComingData')->name('admin-trackings.incoming-data');
Route::post('admin-trackings/outgoing-data/{port_id?}', 'TrackingController@outGoingData')->name('admin-trackings.outgoing-data');
Route::get('admin-trackings/status-ported/{id}/is-global/{is_global?}', [
        'as' => 'status-ported', 
        'uses' => 'TrackingController@setStatusPorted'
    ]);
Route::get('admin-trackings/status-deported/{id}/is-global/{is_global?}', [
        'as' => 'status-deported', 
        'uses' => 'TrackingController@setStatusDeported'
    ]);
//Route::get('admin-trackings/status-deported/{id}/is-global/{is_global?}', 'TrackingController@setStatusDeported')->name('admin-trackings.status-deported');
Route::resource('admin-trackings', 'TrackingController');

Route::get('admin-global-traffic', 'TrackingController@globalTrackingIndex')->name('admin-global-traffic');
Route::get('admin-delivered-batches', 'TrackingController@deliveredBatchesIndex')->name('admin-delivered-batches');
Route::post('admin-delivered-batches/data', 'TrackingController@deliveredBatchesData')->name('admin-delivered-batches.data');

Route::post('admin-pricings/data', 'PricingController@data')->name('admin-pricings.data');
Route::resource('admin-pricings', 'PricingController');

Route::post('admin-users/data', 'UserController@data')->name('admin-users.data');
Route::resource('admin-users', 'UserController');
//--------------------------------client urls----------------------------------
Route::post('client-booking/data', 'BookingController@data')->name('client-booking.data');
Route::resource('client-booking', 'BookingController');

Route::get('client-dashboard', 'BookingController@dashboard')->name('client-dashboard');
Route::get('admin-dashboard', 'AdminDashboardController@index')->middleware(['auth'])->name('admin-dashboard');

