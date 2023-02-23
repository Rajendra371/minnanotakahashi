<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Product'], function () {
    
	Route::get('/product_order_data','ProductOrderController@product_order_data');
    Route::get('/product_order/product_order_list','ProductOrderController@product_order_list');
    Route::post('/product_order/order_view','ProductOrderController@order_view');
    Route::post('/product_order/change_order_status','ProductOrderController@change_order_status');
    Route::post('/product_order/get_order_status','ProductOrderController@get_order_status');
    Route::post('/product_order/change_item_status','ProductOrderController@change_item_status');
});
