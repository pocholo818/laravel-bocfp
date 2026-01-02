<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Laravel\Services\CustomValidator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // redirect to custom view path
        View::addLocation(app_path('Laravel/Views'));

        // custom validator
        Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new CustomValidator($translator, $data, $rules, $messages);
        });

        Paginator::useBootstrap();

        // idk wtf is this
        // if(env('SECURE_ASSET',FALSE) == TRUE){
        //     $this->app['request']->server->set('HTTPS','on');
        // }
    }
}
