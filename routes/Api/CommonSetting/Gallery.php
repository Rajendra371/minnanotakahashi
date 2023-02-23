<?php

Route::group(['namespace' => 'Api\Gallery'], function () {
    Route::get('/gallery','GalleryController@index');
    Route::get('/gallery/posts','GalleryController@create');
    Route::post('/gallery/store','GalleryController@store');
    Route::post('/gallery/delete','GalleryController@destroy');
    Route::post('/gallery/edit','GalleryController@edit');
    Route::post('/gallery/getTableData','GalleryController@getTableData');
});
