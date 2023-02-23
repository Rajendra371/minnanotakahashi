<?php

/**
 * Contact
 *
 */
Route::group(['namespace' => 'Api\Contact'], function () {
	Route::get('/contact/contact_list', 'ContactController@contact_list');
	Route::post('/contact/view', 'ContactController@view');
	Route::post('/contact/delete', 'ContactController@delete');
});