<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Faq'], function () {
	Route::get('/faq_category','FaqCategoryController@index');

	  Route::post('/faq_category/store','FaqCategoryController@store');
	  Route::post('/faq_category/get_form_data','FaqCategoryController@get_form_data');

      Route::get('/faq_category/faqcategory_list','FaqCategoryController@faqcategory_list');
	  Route::post('/faq_category/faqcategory_edit','FaqCategoryController@faqcategory_edit');
	  Route::post('/faq_category/faqcategory_delete','FaqCategoryController@faqcategory_delete');
    

});
