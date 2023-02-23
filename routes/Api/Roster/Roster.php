<?php

/**
 * Roster
 *
 */
Route::group(['namespace' => 'Api\Roster'], function () {
	Route::post('roster/entry_record', 'RosterController@entry_record');
	Route::post('/roster/get_total_hours', 'RosterController@get_total_hours');
	Route::post('/save_employee_roster_individual', 'RosterController@save_employee_roster_individual');
	Route::post('/save_employee_roster_bulk', 'RosterController@save_employee_roster_bulk');
	Route::post('/save_employeeless_roster', 'RosterController@save_roster_employeless');
	Route::post('/roster/roster_report', 'RosterController@generate_roster_report');
	Route::post('/roster/get_booked_shift_list', 'RosterController@get_booked_shift_list');
	Route::post('/roster/approve_shift', 'RosterController@approve_shift');
	Route::get('/roster/employee_roster_list', 'RosterController@employee_roster_list');
	Route::post('/roster/change_status', 'RosterController@change_status');
});