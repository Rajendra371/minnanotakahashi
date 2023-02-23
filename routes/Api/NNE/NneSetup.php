<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\NNE'], function () {
	Route::get('/nne_setup', 'NneSetupController@index');

	Route::post('/nne_setup/store', 'NneSetupController@store');
	Route::post('/nne_setup/get_form_data', 'NneSetupController@get_form_data');
	Route::post('/nne_setup/nne_view', 'NneSetupController@nne_view');

	Route::get('/nne_setup/nne_list', 'NneSetupController@nne_list');
	Route::post('/nne_setup/nne_edit', 'NneSetupController@nne_edit');
	Route::post('/nne_setup/nne_delete', 'NneSetupController@nne_delete');
});