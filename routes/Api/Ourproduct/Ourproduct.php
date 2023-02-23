<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\ourproduct'], function () {
	Route::get('/ourproduct','OurproductController@index');

	  Route::post('/ourproduct/store','OurproductController@store');
	  Route::post('/ourproduct/get_form_data','OurproductController@get_form_data');

      Route::get('/ourproduct/ourproduct_list','OurproductController@ourproduct_list');
	  Route::post('/ourproduct/ourproduct_edit','OurproductController@ourproduct_edit');
	  Route::post('/ourproduct/ourproduct_delete','OurproductController@ourproduct_delete');
	  Route::post('/ourproduct/ourproduct_view','OurproductController@ourproduct_view');

	  Route::get('/ourproduct_category','OurproductController@ourproduct_index');

	  Route::post('/ourproduct_category/store','OurproductController@ourproductcategory_store');
	//   Route::post('/ourproduct_category/get_form_data','OurproductController@get_form_data');

      Route::get('/ourproduct_category/ourproductcategory_list','OurproductController@ourproductcategory_list');
	  Route::post('/ourproduct_category/ourproductcategory_edit','OurproductController@ourproductcategory_edit');
	  Route::post('/ourproduct_category/ourproductcategory_delete','OurproductController@ourproductcategory_delete');
	  Route::post('/ourproduct_category/technologycategory_view','OurproductController@ourproductcategory_view');
    

});
