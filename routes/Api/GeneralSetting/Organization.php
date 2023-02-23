<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
	Route::get('/organization','OrganizationController@index');

	  Route::post('/organization/store','OrganizationController@store');
	  Route::post('/organization/get_form_data','OrganizationController@get_form_data');

      Route::get('/organization/organization_list','OrganizationController@organization_list');
	  Route::post('/organization/organization_edit','OrganizationController@organization_edit');
	  Route::post('/organization/organization_delete','OrganizationController@organization_delete');
    

});
