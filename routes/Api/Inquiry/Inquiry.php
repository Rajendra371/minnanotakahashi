<?php

/**
 * Inquiry
 *
 */
Route::group(['namespace' => 'Api\Inquiry'], function () {
	Route::get('/ourproduct_enquiry', 'InquiryController@index');
	Route::get('/inquiry/inquiry_list', 'InquiryController@ourproduct_inquiry_list');
	Route::post('/inquiry/view', 'InquiryController@view');
});
