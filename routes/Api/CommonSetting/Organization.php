<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\CommonSetting'], function () {
    Route::get('/organization','OrganizationController@index');
    Route::post('/organization/store','OrganizationController@store');
    Route::post('/organization/delete','OrganizationController@destroy');
    Route::post('/organization/edit','OrganizationController@edit');
    Route::post('/organization/getTableData','OrganizationController@getTableData');
});
