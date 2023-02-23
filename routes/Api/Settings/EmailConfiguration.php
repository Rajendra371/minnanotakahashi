<?php

Route::group(['namespace' => 'Api\Settings'], function () {
    Route::get('/emailconfig','EmailConfigurationController@index');
    Route::post('/emailconfig/store','EmailConfigurationController@store');
    Route::post('/emailconfig/delete','EmailConfigurationController@destroy');
    Route::post('/emailconfig/edit','EmailConfigurationController@edit');
    Route::post('/emailconfig/getTableData','EmailConfigurationController@getTableData');
});
