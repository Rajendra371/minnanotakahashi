<?php
/**
 * Cron
 *
 */
Route::group(['namespace' => 'Api\CommonSetting'], function () {
    Route::get('/cron','CronController@index');
    Route::post('/cron/store','CronController@store');
    Route::post('/cron/delete','CronController@destroy');
    Route::post('/cron/edit','CronController@edit');
    Route::post('/cron/getTableData','CronController@getTableData');
});
