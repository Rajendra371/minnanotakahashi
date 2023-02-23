<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
	Route::get('/usefullink','UsefulLinkController@index');

	  Route::post('/usefullink/store','UsefulLinkController@store');
	  Route::post('/usefullink/get_form_data','UsefulLinkController@get_form_data');

      Route::get('/usefullink/usefullink_list','UsefulLinkController@usefullink_list');
	  Route::post('/usefullink/usefullink_edit','UsefulLinkController@usefullink_edit');
	  Route::post('/usefullink/usefullink_delete','UsefulLinkController@usefullink_delete');
	  Route::post('/usefullink/usefullink_view','UsefulLinkController@usefullink_view');
    

});
