<?php

Route::group(['prefix'=>"child", 'as'=>"child.", 'controller'=>"ChildController"], function(){
    Route::get('/',['as'=>"index", 'uses'=>"index",'middleware' => "backoffice.permission:backoffice.child.index"]);
    Route::get('create',['as'=>"create", 'uses'=>"create",'middleware' => "backoffice.permission:backoffice.child.create"]);
    Route::post('create',['uses'=>"store",'middleware' => "backoffice.permission:backoffice.child.create"]);
    Route::get('edit/{id?}',['as'=>"edit", 'uses'=>"edit",'middleware' => "backoffice.permission:backoffice.child.edit"]);
    Route::post('edit/{id?}',['uses'=>"update",'middleware' => "backoffice.permission:backoffice.child.edit"]);
    // Route::post('export', ['as'=> 'export', 'uses'=>"export",'middleware' => "backoffice.permission:backoffice.child.export"]);
    Route::get('update-status/{id?}',['as'=>"update_status", 'uses'=>"update_status",'middleware' => "backoffice.permission:backoffice.child.update_status"]);
    Route::get('{id?}',['as'=>"show", 'uses'=>"show",'middleware' => "backoffice.permission:backoffice.child.index"]);
});
