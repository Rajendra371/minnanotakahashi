<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Settings'], function () {
    Route::get('/permission','PermissionController@index');
    Route::post('/permission/store','PermissionController@store');
    Route::delete('/permission/delete/{id}','PermissionController@destroy');
    Route::get('/permission/edit/{id}','PermissionController@edit');
    Route::put('/permission/update/{id}','PermissionController@update');
    Route::get('/permission/usergroup','PermissionController@get_usergroup');
    Route::get('/permission/get_module','PermissionController@get_module');
    Route::post('/permission/get_permodule','PermissionController@get_permodule');
});

