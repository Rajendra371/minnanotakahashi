<?php

Route::group(['namespace' => 'Api\Page'], function () {
    Route::get('/blog','BlogController@index');
    Route::post('/blog/store','BlogController@store');
    Route::post('/blog/delete','BlogController@destroy');
    Route::post('/blog/edit','BlogController@edit');
    Route::post('/blog/getTableData','BlogController@getTableData');
});
