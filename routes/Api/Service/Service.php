<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Service'], function () {
	Route::get('/service','ServiceController@index');

	  Route::post('/service/store','ServiceController@store');
	  Route::post('/service/get_form_data','ServiceController@get_form_data');

      Route::get('/service/service_list','ServiceController@service_list');
	  Route::post('/service/service_edit','ServiceController@service_edit');
	  Route::post('/service/service_delete','ServiceController@service_delete');
	  Route::post('/service/service_view','ServiceController@service_view');
    

});
