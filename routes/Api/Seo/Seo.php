<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Seo'], function () {
	  Route::get('/seo','SeoController@index');
	  Route::post('/seo/store','SeoController@store');
	  Route::post('/seo/get_form_data','SeoController@get_form_data');
      Route::get('/seo/seo_list','SeoController@seo_list');
      Route::post('/seo/seo_edit','SeoController@seo_edit');
      Route::post('/seo/seo_delete','SeoController@seo_delete');
      Route::post('/seo/seo_view','SeoController@seo_view');

    
});
