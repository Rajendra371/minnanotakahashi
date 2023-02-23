<?php

/**
 * Study Destination
 */
Route::group(['namespace' => 'Api\AssociatedCollege'], function () {
    Route::post('/associated_college/store', 'AssociatedCollegeController@store');
    Route::get('/associated_college/list', 'AssociatedCollegeController@list');
    Route::post('/associated_college/edit', 'AssociatedCollegeController@edit');
    Route::post('/associated_college/view', 'AssociatedCollegeController@view');
    Route::post('/associated_college/delete', 'AssociatedCollegeController@delete');
});
