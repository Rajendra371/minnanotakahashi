<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Portfolio'], function () {
	Route::get('/portfolio_category','PortfolioCategoryController@index');

	  Route::post('/portfolio_category/store','PortfolioCategoryController@store');
	  Route::post('/portfolio_category/get_form_data','PortfolioCategoryController@get_form_data');

      Route::get('/portfolio_category/portfoliocategory_list','PortfolioCategoryController@portfoliocategory_list');
	  Route::post('/portfolio_category/portfoliocategory_edit','PortfolioCategoryController@portfoliocategory_edit');
	  Route::post('/portfolio_category/portfoliocategory_delete','PortfolioCategoryController@portfoliocategory_delete');
    

});
