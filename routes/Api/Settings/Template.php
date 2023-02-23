<?php
/**
 * Template
 *
 */
Route::group(['namespace' => 'Api\Settings'], function () {
    Route::get('/template','TemplateController@index');
    Route::post('/template/store','TemplateController@store');
    Route::post('/template/delete','TemplateController@destroy');
    Route::post('/template/edit','TemplateController@edit');
    Route::post('/template/getTableData','TemplateController@getTableData');
});
