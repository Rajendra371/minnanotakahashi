<?php
/**
 * Dashboard
 * 
 */
Route::group(['namespace' => 'Api\Dashboard'], function () {
    Route::get('/dashboard','DashboardController@index');
    Route::post('/get_country_data','DashboardController@get_country_data');
    Route::post('/get_gender_data','DashboardController@get_gender_data');
    Route::post('/dashboard/store','DashboardController@index');
});
