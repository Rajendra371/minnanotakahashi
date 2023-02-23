<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Banner'], function () {
	Route::get('/banner','BannerController@index');

	  Route::post('/banner/store','BannerController@store');
	  Route::post('/banner/get_form_data','BannerController@get_form_data');
	  Route::post('/banner/banner_view','BannerController@banner_view');

      Route::get('/banner/banner_list','BannerController@banner_list');
	  Route::post('/banner/banner_edit','BannerController@banner_edit');
	  Route::post('/banner/banner_delete','BannerController@banner_delete');
    

});
