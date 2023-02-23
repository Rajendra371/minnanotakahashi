<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Career'], function () {

    //Career Routes
    Route::post('/career_setup/get_form', 'CareerController@get_form');
    Route::post('/career_setup/store', 'CareerController@store');
    Route::get('/career_list/list', 'CareerController@list');
    Route::post('/career_list/publish_job', 'CareerController@publish_job');
    // Route::post('/career_list/edit', 'CareerController@edit');

    //Job applicant routes
    Route::get('/job_applicant_list/list', 'JobApplicantController@list');
    Route::post('/job_applicant/view', 'JobApplicantController@view');
    Route::post('/job_applicant/delete', 'JobApplicantController@delete');
});