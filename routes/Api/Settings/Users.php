<?php

/**
 * User
 *
 */
Route::group(['namespace' => 'Api\Settings'], function () {
  Route::get('/users', 'UsersController@index');
  Route::post('/users/store', 'UsersController@store');
  Route::post('/users/delete', 'UsersController@destroy');
  Route::post('/users/edit', 'UsersController@edit');
  Route::post('/users/view', 'UsersController@view');
  Route::post('/users/getTableData', 'UsersController@getTableData');
  Route::post('/change_password', 'UsersController@change_password');
});