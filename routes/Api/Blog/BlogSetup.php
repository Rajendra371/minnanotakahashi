<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Blog'], function () {
	Route::get('/blog_setup','BlogSetupController@index');

	  Route::post('/blog_setup/store','BlogSetupController@store');
	  Route::post('/blog_setup/get_form_data','BlogSetupController@get_form_data');

      Route::get('/blog_setup/blogsetup_list','BlogSetupController@blogsetup_list');
	  Route::post('/blog_setup/blogsetup_edit','BlogSetupController@blogsetup_edit');
	  Route::post('/blog_setup/blogsetup_delete','BlogSetupController@blogsetup_delete');
	  Route::post('/blog_setup/blogsetup_view','BlogSetupController@blogsetup_view');
    

});
