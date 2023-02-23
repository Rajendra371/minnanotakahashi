<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Product'], function () {
	Route::get('/product_category','ProductCategoryController@index');

	  Route::post('/product_category/store','ProductCategoryController@store');
	  Route::post('/product_category/get_form_data','ProductCategoryController@get_form_data');
	  Route::get('/product_category/get_parentcat','ProductCategoryController@get_productcat');
      Route::get('/product_category/productcategory_list','ProductCategoryController@productcategory_list');
	  Route::post('/product_category/productcategory_edit','ProductCategoryController@productcategory_edit');
	  Route::post('/product_category/productcategory_delete','ProductCategoryController@productcategory_delete');
	  Route::post('/product_category/productcategory_view','ProductCategoryController@productcategory_view');
    

});
