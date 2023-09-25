<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        /*
        view()->composer('layouts.app', function($view) {
            $view->with('user', auth()->user());
        });
        */

        // Using class based composers...
        // Facades\View::composer('profile', ProfileComposer::class);

        // Using closure based composers...
        /*
        Facades\View::composer('welcome', function (View $view) {
            // ...
        });
        Facades\View::composer('dashboard', function (View $view) {
            // ...
        });
        */
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

}
