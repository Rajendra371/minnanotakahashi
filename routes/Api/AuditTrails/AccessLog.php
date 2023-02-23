<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\AuditTrails'], function () {
	Route::get('/access_log','AccessLogController@index');

      Route::get('/access_log/accesslog_list','AccessLogController@accesslog_list');
	
    

});
