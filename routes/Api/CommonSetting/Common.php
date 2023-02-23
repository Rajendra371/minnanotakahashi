<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\CommonSetting'], function () {
    Route::get('/common/current_date', 'CommonController@load_current_date');
    Route::get('/common/load_system_info', 'CommonController@load_system_info');
    Route::post('/common/num_to_word', 'CommonController@num_to_word');
    Route::post('/cstore', 'CommonController@store');
    Route::get('/common_form_data', 'CommonController@getCommonFormData');
});