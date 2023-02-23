<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Product'], function () {
    
    Route::get('/deliver_order/delivery_list','DeliveryManagementController@delivery_list');
    Route::post('/deliver_order/assign_user_to_deliver_order','DeliveryManagementController@assign_user_to_deliver_order'); 
    Route::post('/deliver_order/get_delivery_status','DeliveryManagementController@get_delivery_status');
    Route::post('deliver_order/change_delivery_status_completed','DeliveryManagementController@change_delivery_status_completed');
});
