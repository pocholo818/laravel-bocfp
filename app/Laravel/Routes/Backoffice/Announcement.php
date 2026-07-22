<?php

Route::group(['prefix'=>"announcement", 'as'=>"announcement.", 'controller'=>"AnnouncementController"], function(){
    Route::get('/',['as'=>"index", 'uses'=>"index",'middleware' => "backoffice.permission:backoffice.announcement.index"]);
    Route::get('create',['as'=>"create", 'uses'=>"create",'middleware' => "backoffice.permission:backoffice.announcement.create"]);
    Route::post('create',['uses'=>"store",'middleware' => "backoffice.permission:backoffice.announcement.create"]);
    Route::get('edit/{id?}',['as'=>"edit", 'uses'=>"edit",'middleware' => "backoffice.permission:backoffice.announcement.edit"]);
    Route::post('edit/{id?}',['uses'=>"update",'middleware' => "backoffice.permission:backoffice.announcement.edit"]);
    // Route::post('export', ['as'=> 'export', 'uses'=>"export",'middleware' => "backoffice.permission:backoffice.announcement.export"]);
});
