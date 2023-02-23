<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\CommonSetting'], function () {
    Route::get('/software','SoftwareController@index');
    Route::post('/software/store','SoftwareController@store');
    Route::post('/software/delete','SoftwareController@destroy');
    Route::post('/software/edit','SoftwareController@edit');
    Route::post('/software/getTableData','SoftwareController@getTableData');
});
