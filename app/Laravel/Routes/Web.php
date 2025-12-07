<?php

use Illuminate\Support\Facades\Route;
$namespace = "App\Laravel\Controllers";

Route::group(['as' => "web.",
    'namespace' => $namespace,
    'middleware' => ["web"]
],function() {
    Route::get('/',['as' => "index", 'uses' => "HomeController@welcome"]);
    // Route::get('home',['as' => "home", 'uses' => "HomeController@home"]);

    include_once app_path('Laravel/Routes/Web/Auth.php');
});