<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
	// Route::get('/location','LocationController@index');
	//   Route::post('/location/store','LocationController@store');
	//   Route::post('/location/get_form_data','LocationController@get_form_data');
	Route::get('/location/location_list', 'LocationController@location_list');
	Route::post('/location/location_edit', 'LocationController@location_edit');
	Route::post('/location/location_delete', 'LocationController@location_delete');
});