<?php

/**
 * Study Destination
 */
Route::group(['namespace' => 'Api\StudyDestination'], function () {
    Route::post('/study_destination/store', 'StudyDestinationController@store');
    Route::get('/study_destination/list', 'StudyDestinationController@list');
    Route::post('/study_destination/edit', 'StudyDestinationController@edit');
    Route::post('/study_destination/view', 'StudyDestinationController@view');
    Route::post('/study_destination/delete', 'StudyDestinationController@delete');
});
