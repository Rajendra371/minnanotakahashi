<?php
/**
 * Blog Category
 *
 */
Route::group(['namespace' => 'Api\Blog'], function () {
    Route::get('/blog','BlogController@index');
    Route::post('/blog/store','BlogController@store');
    Route::post('/blog/edit','BlogController@edit');
    Route::get('/blog/getmenu','BlogController@get_menu');
    Route::post('/blog/delete','BlogController@destroy');
    Route::put('/blog/get_moduleslist','PermissionController@get_usergroup');
    Route::post('/blog/getTableData','BlogController@getTableData');
    Route::get('/blog/showmenu','BlogController@show_menu');
    Route::post('/moduleorder','BlogController@moduleorder');
    Route::get('/blog/showmenuorder','BlogController@showmenuorder');
    Route::get('/blog/getmodalData','BlogController@getModalData');
    Route::post('/blog/updateallmoduleorder','BlogController@updateallmoduleorder');
    Route::get('/tab_menu','ModuleController@tab_menu');

});

