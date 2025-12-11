<?php

Route::group(['prefix'=>"", 'as'=>"auth.", "controller" => "AuthenticationController"/*,'middleware'=>"backoffice.guest"*/], function(){
    Route::get('login', ['as' => "login", 'uses' => "login"]);
    // Route::get('login', ['as' => "login", 'uses' => "login"]);
    // Route::post('login', ['as' => "authenticate", 'uses' => "authenticate"]);
    
    // Route::get('forgot-password', ['as' => "forgot_password", 'uses' => "forgot_password"]);
    // Route::post('forgot-password', ['uses' => "forgot_password_email"]);

    // Route::get('reset-password/{refid}', ['as' => "reset_password", 'uses' => "reset_password"]);
    // Route::post('reset-password/{refid}', ['uses' => "store_password"]);
});