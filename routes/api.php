<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::name('api.')->namespace('Api')->group(function () {
    // Unprotected routes
    Route::group(['middleware' => 'guest:api'], function () {
        Route::namespace('Auth')->group(function () {
            Route::post('login', 'LoginController@login')->name('login');
            Route::post('register', 'RegisterController@register')->name('register');

            // Password Reset Routes...
            Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
            Route::post('password/reset', 'ResetPasswordController@reset');
            // Socialite Login
            Route::post('google/signin', 'GoogleSignInController@SignIn');
            Route::post('google_login', 'LoginController@GoogleLogin');
            Route::post('facebook_login', 'LoginController@FacebookLogin');
            // Guest Checkout
            Route::post('guest_checkout', 'LoginController@guest_checkout');
            Route::post('reset_user_password', 'RegisterController@reset_user_password');
            Route::post('submit_reset_code', 'RegisterController@submit_reset_code');
            Route::post('user_change_password', 'RegisterController@user_change_password');
        });
    });

    // Protected routes
    Route::middleware('jwt.auth')->group(function () {
        Route::namespace('Auth')->group(function () {
            // Route::get('me', 'MeController@me')->name('me');
            Route::post('/password/change_password', 'ResetPasswordController@change_password')->name('change_password');
            Route::post('/change_password', 'LoginController@change_password')->name('change_password');
            Route::get('/user_detail', 'LoginController@user_detail')->name('user_detail');
            Route::post('/customer_change_password', 'LoginController@customer_change_password')->name('customer_change_password');
            Route::post('logout', 'LogoutController@logout')->name('logout');
            Route::get('/home/get_frontend_data', 'HomeController@get_frontend_data');
            Route::post('/resend_verification_code', 'RegisterController@resend_verification_code');
            Route::post('/verify_email', 'RegisterController@verify_email');
        });
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('jwt.auth')->group(function(){

// });
Route::post('me', 'Api\Auth\MeController@me')->name('me');
//includeRouteFiles(__DIR__.'/Api/');
Route::middleware('jwt.auth')->group(function () {
    includeRouteFiles(__DIR__ . '/Api/');
    includeRouteFiles(__DIR__ . '/Dashboard/');
});


// Common Loads
Route::group(['namespace' => 'Api\CommonSetting'], function () {
    Route::get('/check_site_status', 'CommonController@check_site_status');
    Route::post('/maintenance_key_access', 'CommonController@maintenance_key_access');

    Route::get('load_system_info', 'CommonController@load_system_info');
    Route::get('/common/current_date', 'CommonController@load_current_date');
});

Route::group(['namespace' => 'Api\Home'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/home/get_frontend_data', 'HomeController@get_frontend_data');
    Route::get('/home/get_services', 'HomeController@get_services');
    Route::get('/home/get_nav_category', 'HomeController@get_nav_category');
    Route::post('/home/get_product_detail', 'HomeController@get_product_detail');
    Route::post('/home/save_product_review', 'HomeController@save_product_review');
    Route::get('/home/get_nav_menu', 'HomeController@get_nav_menu');
    Route::post('/home/search', 'HomeController@search');
    Route::post('/get_category_from_slug', 'HomeController@get_category_from_slug');
    Route::post('/get_page_details', 'HomeController@get_page_details');
    Route::get('/home/about_us', 'HomeController@about_us');
    Route::get('/home/faq', 'HomeController@get_faq');
    Route::get('/get_blog_list/{limit?}', 'HomeController@get_blog_list');
    Route::get('/get_news_list', 'HomeController@get_news_list');
    Route::get('/get_study_destination_list', 'HomeController@get_study_destination_list');
    Route::post('/get_study_destination_detail', 'HomeController@get_study_destination_detail');
    Route::post('/get_blog_detail', 'HomeController@get_blog_detail');
    Route::get('/get_gallery_category', 'HomeController@get_gallery_category');
    Route::post('/get_gallery_images', 'HomeController@get_gallery_images');
    Route::post('/get_news_detail', 'HomeController@get_news_detail');
    Route::post('/get_sales_product', 'HomeController@get_sales_product');
    Route::post('/track_order', 'HomeController@track_order');
    Route::get('/get_video_list', 'HomeController@get_video_list');
});

Route::group(['namespace' => 'Api\Product'], function () {
    Route::post('/cart/add', 'CartController@add');
    Route::get('/cart/get', 'CartController@get');
    Route::post('/cart/remove', 'CartController@remove');
    Route::post('/cart/update', 'CartController@update');
    Route::post('/cart/add-favorite', 'CartController@add_favorite');
    Route::get('/cart/get-favorite', 'CartController@get_favorite');
    Route::post('/cart/remove-favorite', 'CartController@remove_favorite');
});

Route::group(['namespace' => 'Api\Checkout'], function () {
    Route::post('/add_checkout_address', 'CheckoutController@add_checkout_address');
    Route::post('/add_payment_method', 'CheckoutController@add_payment_method');
    Route::get('/confirm_checkout_order', 'CheckoutController@confirm_checkout_order');
    Route::get('/product_order_print/{orderId}/{print}', 'CheckoutController@send_order_mail');
});

Route::group(['namespace' => 'Api\CommonData'], function () {
    Route::get('/get_payment_method', 'CommonDataController@get_payment_method');
    Route::get('/get_month', 'CommonDataController@get_month');
    Route::get('/get_colorlist', 'CommonDataController@get_colorlist');
    Route::get('/get_product_size', 'CommonDataController@get_product_size');
    Route::get('/get_search_filter_data', 'CommonDataController@get_search_filter_data');
    Route::get('/get_seo_data', 'CommonDataController@get_seo_data');
    Route::get('/get_province', 'CommonDataController@get_province');
    Route::post('/get_district', 'CommonDataController@get_district');
    Route::post('/get_region', 'CommonDataController@get_region');
    Route::post('/get_address_name', 'CommonDataController@get_address_name');
    Route::post('/custom_carpet_order_store', 'CommonDataController@custom_carpet_order_store');
    Route::get('/get_footer_address', 'CommonDataController@get_footer_address');
    Route::get('/get_default_currency', 'CommonDataController@get_default_currency');
});

Route::group(['namespace' => 'Api\Employee'], function () {
    Route::get('/employee/generate_pdf', 'EmployeeController@get_employee_data_pdf');
    Route::get('/employee/generate_excel', 'EmployeeController@get_employee_data_excel');
    Route::get('/employee/generate_word', 'EmployeeController@get_employee_data_word');
});
Route::post('/gallery_setup/upload_image', 'Api\Gallery\GallerySetupController@upload_image')->name('gallery.upload_image');
Route::get('/roster/download_roster_pdf', 'Api\Roster\RosterController@download_roster_pdf');
Route::get('/roster/download_roster_excel', 'Api\Roster\RosterController@download_roster_excel');


// Route::group(['namespace' => 'Api\Customer'], function () {
//     Route::post('/customer/save_attachments', 'CustomerController@save_attachments');
// });

Route::get('/sendemail', 'Api\EmailTesterController@testEmail');
Route::get('/test', 'Api\EmailTesterController@test');
// Route::get('/order_email','Api\Checkout\CheckoutController@send_order_mail'); 
Route::get('/product_color_manage', 'Api\Api\TestController@product_color_manage');
Route::get('/product_material_manage', 'Api\Api\TestController@product_material_manage');
Route::get('/product_manage_image', 'Api\Api\TestController@product_manage_image');
Route::get('/rename_file', 'Api\EmailTesterController@renameFile');
Route::get('/remove_image', 'Api\EmailTesterController@removeImage');
Route::get('/compress_gallery_images', 'Api\Gallery\GallerySetupController@compress_gallery_images');