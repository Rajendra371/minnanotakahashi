<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
	Route::get('/sitesetting','SiteSettingController@index');

	  Route::post('/sitesetting/store','SiteSettingController@store');
	  Route::post('/sitesetting/get_form_data','SiteSettingController@get_form_data');

      Route::get('/sitesetting/list','SiteSettingController@list');
	  Route::post('/sitesetting/edit','SiteSettingController@edit');
	  Route::post('/sitesetting/delete','SiteSettingController@delete');
	//   Route::post('/sitesetting/timezone_list','SiteSettingController@timezone_list');
    

});
