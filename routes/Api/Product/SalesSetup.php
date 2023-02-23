<?php
/**
 * Product Sales Setup
 *
 */
Route::group(['namespace' => 'Api\Product'], function () {
	Route::get('/sales_setup/get_form_template','SalesSetupController@get_from_template');
	Route::get('/sales_product/product_datatable_list','SalesSetupController@product_datatable_list');
	Route::get('/sales_setup/get_sales_list','SalesSetupController@get_sales_list');
	Route::post('/sales_setup/store','SalesSetupController@store');
    Route::post('/sales_setup/get_product_list','SalesSetupController@get_product_list');

});
