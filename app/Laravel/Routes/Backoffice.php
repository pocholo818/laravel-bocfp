<?php

use Illuminate\Support\Facades\Route;
$namespace = "App\Laravel\Controllers\Backoffice";

/*
    still conflicted to whether name it as web or backoffice
*/
Route::group(['as' => "web.",
    'namespace' => $namespace,
    'middleware' => ["web"]
],function() {
    Route::get('/',['as' => "index", 'uses' => "HomeController@welcome"]);

    include_once app_path('Laravel/Routes/Backoffice/Auth.php');
});