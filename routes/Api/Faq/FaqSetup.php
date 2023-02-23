<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Faq'], function () {
	Route::get('/faq_setup','FaqSetupController@index');

	  Route::post('/faq_setup/store','FaqSetupController@store');
	  Route::post('/faq_setup/get_form_data','FaqSetupController@get_form_data');

      Route::get('/faq_setup/faqsetup_list','FaqSetupController@faqsetup_list');
	  Route::post('/faq_setup/faqsetup_edit','FaqSetupController@faqsetup_edit');
	  Route::post('/faq_setup/faqsetup_delete','FaqSetupController@faqsetup_delete');
	  Route::post('/faq_setup/faqsetup_view','FaqSetupController@faqsetup_view');
    

});
