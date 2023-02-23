<?php

/**
 * Employee
 *
 */
Route::group(['namespace' => 'Api\Employee'], function () {

    //Employee route
    Route::get('/employee/get_form_data', 'EmployeeController@formData');
    Route::get('/employee/datatable_list', 'EmployeeController@datatableList');
    Route::post('/employee/store', 'EmployeeController@store');
    Route::post('/employee/view', 'EmployeeController@view');
    Route::post('/employee/edit', 'EmployeeController@edit');
    Route::get('/general_data/list', 'EmployeeController@general_data');
    Route::post('/general_data/get_employee', 'EmployeeController@get_employee');
    Route::post('/employee/get_loc_emp_code', 'EmployeeController@get_loc_emp_code');
    Route::post('/employee/resign', 'EmployeeController@employee_resign');

    //Employee Type setup route
    Route::post('/employee_type_setup/store', 'EmployeeTypeController@store');
    Route::post('/employee_type_setup/getTableData', 'EmployeeTypeController@getTableData');
    Route::post('/employee_type_setup/edit', 'EmployeeTypeController@edit');
    Route::post('/employee_type_setup/delete', 'EmployeeTypeController@destroy');

    //Department route
    Route::get('/department', 'DepartmentController@index');
    Route::get('/department/get_form_data', 'DepartmentController@formData');
    Route::post('/department/get_table_data', 'DepartmentController@list');
    Route::post('/department/store', 'DepartmentController@store');
    Route::post('/department/edit', 'DepartmentController@edit');
    Route::post('/department/delete', 'DepartmentController@destroy');

    //Designation route
    Route::get('/designation', 'DesignationController@index');
    Route::post('/designation/get_table_data', 'DesignationController@list');
    Route::post('/designation/store', 'DesignationController@store');
    Route::post('/designation/edit', 'DesignationController@edit');
    Route::post('/designation/delete', 'DesignationController@destroy');
});