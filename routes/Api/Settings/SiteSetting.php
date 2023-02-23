<?php

Route::group(['namespace' => 'Api\Settings'], function () {
    Route::get('/sitelanguage','SiteSettingController@index');
    Route::post('/sitelanguage/store','SiteSettingController@store');
    Route::post('/sitelanguage/delete','SiteSettingController@destroy');
    Route::post('/sitelanguage/edit','SiteSettingController@edit');
    Route::post('/sitelanguage/getTableData','SiteSettingController@getTableData');


    Route::get('/sitetimezone','SiteSettingController@index');
    Route::get('/sitecurrency','SiteSettingController@index');


});
