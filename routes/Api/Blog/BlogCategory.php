<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Blog'], function () {
	Route::get('/blog_category','BlogCategoryController@index');

	  Route::post('/blog_category/store','BlogCategoryController@store');
	  Route::post('/blog_category/get_form_data','BlogCategoryController@get_form_data');

      Route::get('/blog_category/blogcategory_list','BlogCategoryController@blogcategory_list');
	  Route::post('/blog_category/blogcategory_edit','BlogCategoryController@blogcategory_edit');
	  Route::post('/blog_category/blogcategory_delete','BlogCategoryController@blogcategory_delete');
	  Route::post('/blog_category/blogcategory_view','BlogCategoryController@blogcategory_view');
    

});
