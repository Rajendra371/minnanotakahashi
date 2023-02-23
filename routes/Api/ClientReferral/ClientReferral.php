<?php

/**
 * Customer
 *
 */
Route::group(['namespace' => 'Api\ClientReferral'], function () {
    Route::get('/client_referral/list', 'ClientReferralController@list');
    Route::post('/client_referral/view', 'ClientReferralController@view');
    Route::post('/client_referral/delete', 'ClientReferralController@delete');

    Route::get('/quick_evaluation/list', 'ClientReferralController@evaluation_list');
    Route::post('/quick_evaluation/view', 'ClientReferralController@evaluation_view');
    Route::post('/quick_evaluation/delete', 'ClientReferralController@evaluation_delete');

    //Support Forms SDA/SIL
    Route::get('/support_referral/list', 'ClientReferralController@support_list');
    Route::post('/support_referral/view', 'ClientReferralController@support_view');
    Route::post('/support_referral/delete', 'ClientReferralController@support_delete');
});

Route::group(['namespace' => 'Api\State'], function () {
    Route::get('/state_setup/list', 'StateController@list');
    Route::post('/state_setup/store', 'StateController@store');
    Route::post('/state_setup/edit', 'StateController@edit');
    Route::post('/state_setup/delete', 'StateController@delete');
});