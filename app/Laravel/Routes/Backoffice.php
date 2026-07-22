<?php

use Illuminate\Support\Facades\Route;
$namespace = "App\Laravel\Controllers\Backoffice";

/*
    still conflicted to whether name it as web or backoffice
*/
Route::group([
    'as' => "backoffice.",
    'namespace' => $namespace,
    'middleware' => ["web"]
],function() {
    
    include_once app_path('Laravel/Routes/Backoffice/Auth.php');

    Route::group(['middleware' => "backoffice.auth"], function(){
        Route::group(['as' => "auth."], function () {
            Route::get('logout', ['as' => "logout", 'uses' => "AuthenticationController@logout"]);
        });

        Route::get('/',['as' => "index", 'uses' => "MainController@index"]);
        include_once app_path('Laravel/Routes/Backoffice/Admin.php');
        include_once app_path('Laravel/Routes/Backoffice/Child.php');
        include_once app_path('Laravel/Routes/Backoffice/Guardian.php');
        include_once app_path('Laravel/Routes/Backoffice/Record.php');
        include_once app_path('Laravel/Routes/Backoffice/Announcement.php');
    });
});