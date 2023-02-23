<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Page'], function () {
	 
	  Route::get('/page','PagesController@index');
	  Route::post('/page/store','PagesController@store');
	  Route::post('/page/get_form_data','PagesController@get_form_data');
      Route::get('/page/page_list','PagesController@page_list');
	  Route::post('/page/page_edit','PagesController@page_edit');
	  Route::post('/page/page_delete','PagesController@page_delete');
	  Route::post('/page/page_view','PagesController@page_view');
    

});
