<?php

Route::group(['prefix'=>"admin", 'as'=>"admin.", 'controller'=>"AdminController"], function(){
    Route::get('/',['as'=>"index", 'uses'=>"index",'middleware' => "backoffice.permission:backoffice.admin.index"]);
    Route::get('create',['as'=>"create", 'uses'=>"AdminController@create",'middleware' => "backoffice.permission:backoffice.admin.create"]);
    Route::post('create',['uses'=>"AdminController@store",'middleware' => "backoffice.permission:backoffice.admin.create"]);
    Route::get('edit/{id?}',['as'=>"edit", 'uses'=>"AdminController@edit",'middleware' => "backoffice.permission:backoffice.admin.edit"]);
    Route::post('edit/{id?}',['uses'=>"AdminController@update",'middleware' => "backoffice.permission:backoffice.admin.edit"]);
    // Route::post('export', ['as'=> 'export', 'uses'=>"AdminController@export",'middleware' => "backoffice.permission:backoffice.admin.export"]);
    Route::get('reset-password/{id?}', ['as'=> 'reset_password', 'uses'=>"AdminController@update_password",'middleware' => "backoffice.permission:backoffice.admin.reset_password"]);
    // Route::post('change-password/{id?}', ['uses'=>"AdminController@update_password"]);
    Route::get('update-status/{id?}',['as'=>"update_status", 'uses'=>"AdminController@update_status",'middleware' => "backoffice.permission:backoffice.admin.update_status"]);
    Route::get('{id?}',['as'=>"show", 'uses'=>"AdminController@show",'middleware' => "backoffice.permission:backoffice.admin.index"]);
});
