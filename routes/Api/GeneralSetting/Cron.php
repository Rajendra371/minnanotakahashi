<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
	Route::get('/cron','CronController@index');

	  Route::post('/cron/store','CronController@store');
	  Route::post('/cron/get_form_data','CronController@get_form_data');

      Route::get('/cron/cron_list','CronController@cron_list');
	  Route::post('/cron/cron_edit','CronController@cron_edit');
	  Route::post('/cron/cron_delete','CronController@cron_delete');
	  Route::post('/cron/cron_view','CronController@cron_view');
    

});
