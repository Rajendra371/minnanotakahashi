<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
	Route::get('/socialmediaintegration','SocialMediaController@index');

	  Route::post('/socialmediaintegration/store','SocialMediaController@store');
	  Route::post('/socialmediaintegration/get_form_data','SocialMediaController@get_form_data');

      Route::get('/socialmediaintegration/socialmedia_list','SocialMediaController@socialmedia_list');
	  Route::post('/socialmediaintegration/socialmedia_edit','SocialMediaController@socialmedia_edit');
	  Route::post('/socialmediaintegration/socialmedia_delete','SocialMediaController@socialmedia_delete');
    

});
