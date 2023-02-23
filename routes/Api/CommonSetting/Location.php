<?php

/**
 * Location
 *
 */
Route::group(['namespace' => 'Api\CommonSetting'], function () {
    Route::get('/location', 'LocationController@index');
    Route::post('/location/store', 'LocationController@store');
    Route::post('/location/delete', 'LocationController@destroy');
    Route::post('/location/edit', 'LocationController@edit');
    Route::post('/location/view', 'LocationController@view');
    Route::post('/location/getTableData', 'LocationController@getTableData');
});