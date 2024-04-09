<?php
$requrl = Request::url();
if (strpos($requrl, 'admin') !== false || strpos($requrl, 'badministrator') !== false) {

    Route::get('/admin', function () {
        return view('index');
    })->where('any', '.*');

    Route::get('/badministrator', function () {
        return view('index');
    })->where('any', '.*');

    Route::get('/badministrator/{any}', function () {
        return view('index');
    })->where('any', '.*');
} else {
    Route::get('/maintenance_mode', 'Api\Frontend\HomeController@maintenance')->name('maintenance');
    Route::post('/maintenance_mode', 'Api\Frontend\HomeController@maintenance_submit');
    Route::middleware(['setiplog', 'maintenance'])->group(function () {

        Route::namespace('Api\Frontend')->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::get('/about', 'HomeController@about')->name('about');
            Route::get('/who_are_we', 'HomeController@who_are_we')->name('who_are_we');
            Route::get('/why_global_eye_education', 'HomeController@choose')->name('choose');
            Route::get('/branch', 'HomeController@branch')->name('branch');
            Route::get('/services', 'HomeController@services')->name('services');
            Route::get('/service_details/{slug?}', 'HomeController@service_details')->name('service-details');
            Route::get('/training', 'HomeController@training')->name('training');
            Route::get('/training_details/{slug?}', 'HomeController@training_details')->name('training-details');
            Route::get('/study-abroad', 'HomeController@destination')->name('study-abroad');
            Route::get('/study-abroad/{slug?}', 'HomeController@destination_details')->name('destination-details');
            
            Route::get('/gallery', 'HomeController@gallery')->name('gallery');
            Route::get('/gallery/{id}', 'HomeController@gallery_details')->name('gallery-details');
            Route::get('/team/{slug}', 'HomeController@team_details')->name('team-details');

            Route::get('/blog', 'HomeController@blog')->name('blog');
            Route::get('/categories/{cat_slug}', 'HomeController@categories');
            Route::get('/blog_detail/{slug?}', 'HomeController@blog_detail')->name('blog-details');
            Route::get('/product', 'HomeController@product');
            Route::get('/product_detail/{product_slug}', 'HomeController@product_detail');
            Route::get('/contact', 'HomeController@contact')->name('contact');
            Route::post('/contact', 'HomeController@contact_us')->name('contact-us');
            Route::post('/appointment', 'HomeController@appointment')->name('appointment');
            Route::get('/country', 'HomeController@country')->name('country');
            Route::get('/countrywise_university/{university_slug}','HomeController@country_detail')->name('country-details');
            Route::get('/universities', 'HomeController@universities')->name('universities');
            // Route::get('/referral_form', 'HomeController@referral_form')->name('referral-form');
            // Route::post('/referral_form', 'HomeController@referral_form_save')->name('referral-form');
            // Route::get('/sda_form', 'HomeController@sda_form')->name('sda-form');
            // Route::get('/sil_form', 'HomeController@sil_form')->name('sil-form');
            // Route::post('/support_form', 'HomeController@support_form_save')->name('support-form-save');
            // Route::post('/enquiry', 'HomeController@enquiry');
            // Route::get('/career', 'HomeController@career')->name('career');
            // Route::get('/career/{id}/details', 'HomeController@career_details')->name('career-details');
            // Route::post('/apply_job', 'HomeController@apply_job')->name('apply-job');
            Route::get('/faqs', 'HomeController@faqs')->name('faqs');
            Route::get('/book_appointment', 'HomeController@book_appointment')->name('book-appointment');
            Route::get('/message_from_founder', 'HomeController@message_from_founder')->name('message-from-founder');
            Route::get('/message_from_ceo', 'HomeController@message_from_ceo')->name('message-from-ceo');
            Route::get('/team', 'HomeController@team')->name('team');
            Route::get('/video', 'HomeController@video')->name('video');
            Route::get('/events','HomeController@events')->name('events');
            Route::get('/events_detail/{events_slug}','HomeController@events_detail')->name('event-details');
            Route::get('/news','HomeController@news')->name('news');
            Route::get('/news_detail/{news_slug}','HomeController@news_detail')->name('news-details');
            // Route::post('/submit_evaluation_form', 'HomeController@submit_evaluation_form')->name('submit.evaluation_form');
        });



        /*Employee Portal*/
        // Route::namespace('Api\Employee')->middleware(['guest:employee'])->group(function () {
        //     Route::get('/login', 'EmployeePortalController@login_view')->name('login');
        //     Route::post('/login', 'EmployeePortalController@login')->name('login');
        //     Route::get('/forgot_password', 'EmployeePortalController@forgot_password_view')->name('forgot-password');
        //     Route::post('/forgot_password', 'EmployeePortalController@forgot_password')->name('forgot-password');
        //     Route::get('/verify_reset_code', 'EmployeePortalController@verify_reset_code_view')->name('verify-reset-code');
        //     Route::post('/verify_reset_code', 'EmployeePortalController@verify_reset_code')->name('verify-reset-code');
        //     Route::get('/new_password', 'EmployeePortalController@new_password_view')->name('new_password');
        //     Route::post('/new_password', 'EmployeePortalController@new_password')->name('new_password');
        // });

        // Route::middleware(['auth:employee'])->group(function () {
        //     Route::group(['namespace' => 'Api\Employee'], function () {
        //         Route::get('/dashboard', 'EmployeePortalController@dashboard')->name('dashboard');
        //         Route::get('/trainings', 'EmployeePortalController@trainings')->name('trainings');
        //         Route::get('/refresh_training', 'EmployeePortalController@refresh_training')->name('refresh-training');
        //         Route::post('/save_trainings', 'EmployeePortalController@save_trainings')->name('save-training');
        //         Route::post('/shift_view', 'EmployeePortalController@shift_view')->name('shift-view');
        //         Route::get('/refresh_roster', 'EmployeePortalController@refresh_roster')->name('refresh-roster');
        //         Route::get('/refresh_book_shifts', 'EmployeePortalController@refresh_book_shifts')->name('refresh-book-shifts');
        //         Route::get('/change_password', 'EmployeePortalController@change_password_view')->name('change-password');
        //         Route::post('/change_password', 'EmployeePortalController@change_password')->name('change-password');
        //         Route::post('/logout', 'EmployeePortalController@logout')->name('logout');
        //         Route::post('/shift_book', 'EmployeePortalController@shift_book')->name('shift-book');
        //         Route::post('/shift_completed', 'EmployeePortalController@shift_completed')->name('shift-completed');
        //         Route::post('/shift_complete_view', 'EmployeePortalController@shift_complete_view')->name('shift-complete-view');
        //         Route::post('/shift_clockin', 'EmployeePortalController@shift_clockin')->name('shift-clockin');
        //     });
        // });
    });
    Route::get('/clear-cache', function () {
        Artisan::call('optimize:clear');
        return back();
    });
}
