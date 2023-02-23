<?php

Route::group(['namespace'=>'Api\BranchSetup'], function(){
    Route::post('/branch_setup/store','BranchSetupController@store');
    Route::get('/branch_setup/list','BranchSetupController@list');
    Route::post('/branch_setup/edit','BranchSetupController@edit');
    Route::post('/branch_setup/delete','BranchSetupController@delete');
    Route::post('/branch_setup/view','BranchSetupController@view');
});