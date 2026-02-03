<?php

/**
 * Contact
 *
 */
Route::group(['namespace' => 'Api\Appointment'], function () {
	Route::get('/appointment', 'AppointmentController@index');
	Route::get('/appointment/appointment_list', 'AppointmentController@appointment_list');
	Route::post('/appointment/view', 'AppointmentController@view');
	Route::post('/appointment/delete', 'AppointmentController@delete');
});