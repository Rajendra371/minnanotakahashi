<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\TeamTestimonial'], function () {
	Route::get('/teamtestimonial', 'TeamTestimonialController@index');

	Route::post('/teamtestimonial/store', 'TeamTestimonialController@store');
	Route::post('/teamtestimonial/get_form_data', 'TeamTestimonialController@get_form_data');
	Route::post('/teamtestimonial/teamtestimonial_delete', 'TeamTestimonialController@teamtestimonial_delete');

	Route::get('/teamtestimonial/teamtestimonial_list', 'TeamTestimonialController@teamtestimonial_list');
	Route::post('/teamtestimonial/teamtestimonial_edit', 'TeamTestimonialController@teamtestimonial_edit');
	Route::post('/teamtestimonial/teamtestimonial_view', 'TeamTestimonialController@teamtestimonial_view');
});