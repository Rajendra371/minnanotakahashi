<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Gallery'], function () {
	Route::get('/gallery_cat_setup','GalleryCategoryController@index');

	  Route::post('/gallery_cat_setup/store','GalleryCategoryController@store');
	  Route::post('/gallery_cat_setup/get_form_data','GalleryCategoryController@get_form_data');

      Route::get('/gallery_cat_setup/gallerycategory_list','GalleryCategoryController@gallerycategory_list');
	  Route::post('/gallery_cat_setup/gallerycategory_edit','GalleryCategoryController@gallerycategory_edit');
	  Route::post('/gallery_cat_setup/gallerycategory_delete','GalleryCategoryController@gallerycategory_delete');
    

});
