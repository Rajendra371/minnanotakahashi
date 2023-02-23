<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\GeneralSetting'], function () {
  Route::get('/emailintegration', 'EmailIntegrationController@index');

  Route::post('/emailintegration/store', 'EmailIntegrationController@store');
  Route::post('/emailintegration/get_form_data', 'EmailIntegrationController@get_form_data');

  Route::get('/emailintegration/emailintegration_list', 'EmailIntegrationController@emailintegration_list');
  Route::post('/emailintegration/emailintegration_edit', 'EmailIntegrationController@emailintegration_edit');
  Route::post('/emailintegration/emailintegration_delete', 'EmailIntegrationController@emailintegration_delete');

  Route::get('/email_template/data', 'EmailIntegrationController@template_data');
  Route::post('/email_template/store', 'EmailIntegrationController@email_template_store');


  // Route::get('/advertisement','AdvertisementController@index');
  // Route::post('/advertisement/store','AdvertisementController@store');
  // Route::post('/advertisement/delete','AdvertisementController@destroy');
  // Route::post('/advertisement/edit','AdvertisementController@edit');
  // Route::post('/advertisement/getTableData','AdvertisementController@getTableData');
});