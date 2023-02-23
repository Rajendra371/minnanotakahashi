<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Settings'], function () {
    Route::get('/usergroup', 'UserGroupController@index');
    Route::post('/usergroup/store', 'UserGroupController@store');
    Route::post('/usergroup/delete', 'UserGroupController@destroy');
    Route::post('/usergroup/edit', 'UserGroupController@edit');
    Route::post('/usergroup/view', 'UserGroupController@view');
    Route::post('/usergroup/getTableData', 'UserGroupController@getTableData');
});