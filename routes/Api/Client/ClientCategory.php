<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Client'], function () {
	Route::get('/clientcategory','ClientCategoryController@index');

	  Route::post('/clientcategory/store','ClientCategoryController@store');
	  Route::post('/clientcategory/get_form_data','ClientCategoryController@get_form_data');

      Route::get('/clientcategory/clientcategory_list','ClientCategoryController@clientcategory_list');
	  Route::post('/clientcategory/clientcategory_edit','ClientCategoryController@clientcategory_edit');
	  Route::post('/clientcategory/clientcategory_delete','ClientCategoryController@clientcategory_delete');
    

});
