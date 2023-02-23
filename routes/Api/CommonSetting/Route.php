<?php

use Illuminate\Support\Facades\Route;

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\CommonSetting'], function () {
    Route::get('/get_route_data', 'RouteController@route_data');
});
