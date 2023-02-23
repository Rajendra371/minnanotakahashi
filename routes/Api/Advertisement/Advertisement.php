<?php

use Illuminate\Support\Facades\Route;

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Advertisement'], function () {
  Route::get('/advertisement', 'AdvertisementController@index');
  Route::post('/advertisement/store', 'AdvertisementController@store');
  Route::post('/advertisement/get_form_data', 'AdvertisementController@get_form_data');
  Route::get('/advertisement/get_list', 'AdvertisementController@advertisement_list');
  Route::post('/advertisement/advertisement_edit', 'AdvertisementController@advertisement_edit');
  Route::post('/advertisement/advertisement_view', 'AdvertisementController@advertisement_view');
  Route::post('/advertisement/advertisement_delete', 'AdvertisementController@advertisement_delete');
});
