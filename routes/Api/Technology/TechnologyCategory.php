<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Technology'], function () {
	Route::get('/technology_category','TechnologyCategoryController@index');

	  Route::post('/technology_category/store','TechnologyCategoryController@store');
	  Route::post('/technology_category/get_form_data','TechnologyCategoryController@get_form_data');

      Route::get('/technology_category/technologycategory_list','TechnologyCategoryController@technologycategory_list');
	  Route::post('/technology_category/technologycategory_edit','TechnologyCategoryController@technologycategory_edit');
	  Route::post('/technology_category/technologycategory_delete','TechnologyCategoryController@technologycategory_delete');
	  Route::post('/technology_category/technologycategory_view','TechnologyCategoryController@technologycategory_view');
	  Route::get('/technology_description','TechnologyCategoryController@tech_index');

	  Route::post('/technology_description/store','TechnologyCategoryController@tech_store');
	//   Route::post('/technology_description/get_form_data','TechnologyCategoryController@get_form_data');

      Route::get('/technology_description/technologydescription_list','TechnologyCategoryController@technologydescription_list');
	  Route::post('/technology_description/technologydescription_edit','TechnologyCategoryController@technologydescription_edit');
	  Route::post('/technology_description/technologydescription_delete','TechnologyCategoryController@technologydescription_delete');
	  Route::post('/technology_description/technologydescription_view','TechnologyCategoryController@technologydescription_view');
    

});
