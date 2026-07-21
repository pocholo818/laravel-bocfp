<?php

Route::group(['prefix'=>"record", 'as'=>"record.", 'controller'=>"RecordController"], function(){
    Route::get('{child_id?}',['as'=>"index", 'uses'=>"index",'middleware' => "backoffice.permission:backoffice.record.index"]);
    Route::get('{child_id?}/create',['as'=>"create", 'uses'=>"create",'middleware' => "backoffice.permission:backoffice.record.create"]);
    Route::post('{child_id?}/create',['uses'=>"store",'middleware' => "backoffice.permission:backoffice.record.create"]);
    Route::get('{child_id?}/edit/{id?}',['as'=>"edit", 'uses'=>"edit",'middleware' => "backoffice.permission:backoffice.record.edit"]);
    Route::post('{child_id?}/edit/{id?}',['uses'=>"update",'middleware' => "backoffice.permission:backoffice.record.edit"]);
});
