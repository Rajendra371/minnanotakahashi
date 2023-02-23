<?php
/**
 * Menu
 *
 */
Route::group(['namespace' => 'Api\menu'], function () {
    Route::get('/menu','MenuController@index');
    Route::post('/menu/store','MenuController@store');
    Route::post('/menu/edit','MenuController@edit');
    Route::get('/menu/list','MenuController@menu_list');
    Route::get('/menu/getmenu','MenuController@get_menu');
    Route::post('/menu/getTableData','MenuController@getTableData');
    Route::get('/menu/getmodalData','MenuController@getModalData');
    Route::post('/menu/view','MenuController@menu_view');
    Route::post('/menu/delete','MenuController@destroy');
    // Route::get('/ourproduct/ourproduct_list','OurproductController@ourproduct_list');
});

