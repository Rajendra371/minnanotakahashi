<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Product'], function () {
	Route::get('/product_setup','ProductSetupController@index');

	  Route::post('/product_setup/store','ProductSetupController@store');
	 // Route::post('/product_setup/get_form_data','ProductSetupController@get_form_data');
	  Route::get('/product_setup/get_parentcat','ProductSetupController@get_productcat');
      Route::get('/product_setup/productsetup_list','ProductSetupController@productsetup_list');
	  Route::post('/product_setup/productsetup_edit','ProductSetupController@productsetup_edit');
	  Route::post('/product_setup/productsetup_delete','ProductSetupController@productsetup_delete');
	  Route::post('/product_setup/cat','ProductSetupController@cat');
	  


});
