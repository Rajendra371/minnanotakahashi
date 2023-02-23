<?php
/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Portfolio'], function () {
	Route::get('/portfolio_setup','PortfolioSetupController@index');

	  Route::post('/portfolio_setup/store','PortfolioSetupController@store');
	  Route::post('/portfolio_setup/get_form_data','PortfolioSetupController@get_form_data');

      Route::get('/portfolio_setup/portfoliosetup_list','PortfolioSetupController@portfoliosetup_list');
	  Route::post('/portfolio_setup/portfoliosetup_edit','PortfolioSetupController@portfoliosetup_edit');
	  Route::post('/portfolio_setup/portfoliosetup_delete','PortfolioSetupController@portfoliosetup_delete');
	  Route::post('/portfolio_setup/portfoliosetup_view','PortfolioSetupController@portfoliosetup_view');
    

});
