<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\NNE'], function () {
	Route::get('/nne_category','NneCategoryController@index');

	  Route::post('/nne_category/store','NneCategoryController@store');
	  Route::post('/nne_category/getcategory','NneCategoryController@get_category');

      Route::get('/nne_category/nnecategory_list','NneCategoryController@nnecategory_list');
	  Route::post('/nne_category/nnecategory_edit','NneCategoryController@nnecategory_edit');
	  Route::post('/nne_category/nnecategory_delete','NneCategoryController@nnecategory_delete');
    

});
