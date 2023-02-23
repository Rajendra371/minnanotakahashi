<?php

/**
 * Modules
 *
 */
Route::group(['namespace' => 'Api\Settings'], function () {
    Route::get('/module', 'ModuleController@index');
    Route::post('/module/store', 'ModuleController@store');
    Route::post('/module/edit', 'ModuleController@edit');
    Route::get('/module/getmenu', 'ModuleController@get_menu');
    Route::post('/module/delete', 'ModuleController@destroy');
    Route::put('/module/get_moduleslist', 'PermissionController@get_usergroup');
    Route::post('/module/getTableData', 'ModuleController@getTableData');
    Route::get('/module/showmenu', 'ModuleController@show_menu');
    Route::post('/moduleorder', 'ModuleController@moduleorder');
    Route::get('/module/showmenuorder', 'ModuleController@showmenuorder');
    Route::get('/module/getmodalData', 'ModuleController@getModalData');
    Route::post('/module/updateallmoduleorder', 'ModuleController@updateallmoduleorder');
    Route::get('/tab_menu', 'ModuleController@tab_menu');
});