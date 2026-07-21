<?php

Route::group(['prefix'=>"guardian", 'as'=>"guardian.", 'controller'=>"GuardianController"], function(){
    Route::get('/',['as'=>"index", 'uses'=>"index",'middleware' => "backoffice.permission:backoffice.guardian.index"]);
    Route::get('create',['as'=>"create", 'uses'=>"create",'middleware' => "backoffice.permission:backoffice.guardian.create"]);
    Route::post('create',['uses'=>"store",'middleware' => "backoffice.permission:backoffice.guardian.create"]);
    Route::get('edit/{id?}',['as'=>"edit", 'uses'=>"edit",'middleware' => "backoffice.permission:backoffice.guardian.edit"]);
    Route::post('edit/{id?}',['uses'=>"update",'middleware' => "backoffice.permission:backoffice.guardian.edit"]);
    // Route::post('export', ['as'=> 'export', 'uses'=>"export",'middleware' => "backoffice.permission:backoffice.guardian.export"]);
    Route::get('update-status/{id?}',['as'=>"update_status", 'uses'=>"update_status",'middleware' => "backoffice.permission:backoffice.guardian.update_status"]);
    Route::get('{id?}',['as'=>"show", 'uses'=>"show",'middleware' => "backoffice.permission:backoffice.guardian.index"]);
    Route::get('{id?}/add-child',['as'=>"add_child", 'uses'=>"add_child",'middleware' => "backoffice.permission:backoffice.guardian.add_child"]);
    Route::post('{id?}/add-child',['uses'=>"store_child",'middleware' => "backoffice.permission:backoffice.guardian.add_child"]);
});
