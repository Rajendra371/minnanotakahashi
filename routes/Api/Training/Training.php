<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Training'], function () {
	Route::get('/training','TrainingController@index');

	  Route::post('/training/store','TrainingController@store');
	  Route::post('/training/get_form_data','TrainingController@get_form_data');

      Route::get('/training/training_list','TrainingController@training_list');
	  Route::post('/training/training_edit','TrainingController@training_edit');
	  Route::post('/training/training_delete','TrainingController@training_delete');
	  Route::post('/training/training_view','TrainingController@training_view');
    

});
