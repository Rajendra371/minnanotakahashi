<?php

/**
 * Study Destination
 */
Route::group(['namespace' => 'Api\University'], function () {
    Route::get('/university', 'UniversityController@index');
    Route::post('/university/store', 'UniversityController@store');
    Route::get('/university/list', 'UniversityController@list');
    Route::post('/university/edit', 'UniversityController@edit');
    Route::post('/university/view', 'UniversityController@view');
    Route::post('/university/delete', 'UniversityController@delete');
});
