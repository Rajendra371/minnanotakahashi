<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Client'], function () {
	Route::get('/client','ClientSetupController@index');

	  Route::post('/client/store','ClientSetupController@store');
	  Route::post('/client/get_form_data','ClientSetupController@get_form_data');

      Route::get('/client/client_list','ClientSetupController@client_list');
	  Route::post('/client/client_edit','ClientSetupController@client_edit');
	  Route::post('/client/client_delete','ClientSetupController@client_delete');
	  Route::post('/client/client_view','ClientSetupController@client_view');
    

});
