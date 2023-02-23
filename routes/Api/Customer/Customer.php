<?php

/**
 * Customer
 *
 */
Route::group(['namespace' => 'Api\Customer'], function () {
	Route::post('/customer/save_customer_profile', 'CustomerController@save_customer_profile');
	Route::post('/customer/save_customer_address', 'CustomerController@save_customer_address');
	Route::get('/customer/order_list', 'CustomerController@order_list');
	Route::get('/customer/user_detail_list', 'CustomerController@user_detail_list');
	Route::post('/customer/save_attachments', 'CustomerController@save_attachments');
	Route::post('/customer/view', 'CustomerController@view');
});
