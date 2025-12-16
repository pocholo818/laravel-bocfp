<?php

use Illuminate\Support\Facades\Route;
$namespace = "App\Laravel\Controllers\Backoffice";

/*
    still conflicted to whether name it as web or backoffice
*/
Route::group(['as' => "backoffice.",
    'namespace' => $namespace,
    'middleware' => ["web"]
],function() {
    Route::get('/',['as' => "index", 'uses' => "HomeController@index"]);

    include_once app_path('Laravel/Routes/Backoffice/Auth.php');
    include_once app_path('Laravel/Routes/Backoffice/Admin.php');
});