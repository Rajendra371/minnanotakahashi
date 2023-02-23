<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($settings) {
            $settings->with('services_menu',  DB::table('services')
                ->select('id', 'slug', 'service_name')
                ->where('is_publish', 'Y')
                ->where('for_form', 'N')
                ->orderBy('order', 'ASC')
                ->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}