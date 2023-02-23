<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\AuditTrails'], function () {
	Route::get('/audit_trail','AuditTrailsController@index');

	//   Route::post('/banner/store','BannerController@store');
	//   Route::post('/banner/get_form_data','BannerController@get_form_data');

      Route::get('/audit_trail/audittrails_list','AuditTrailsController@audittrails_list');
	//   Route::post('/banner/banner_edit','BannerController@banner_edit');
	//   Route::post('/banner/banner_delete','BannerController@banner_delete');
    

});
