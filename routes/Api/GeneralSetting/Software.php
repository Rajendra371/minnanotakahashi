<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
	Route::get('/software','SoftwareController@index');

	  Route::post('/software/store','SoftwareController@store');
	  Route::post('/software/get_form_data','SoftwareController@get_form_data');

      Route::get('/software/software_list','SoftwareController@software_list');
	  Route::post('/software/software_edit','SoftwareController@software_edit');
	  Route::post('/software/software_delete','SoftwareController@software_delete');
    

});
