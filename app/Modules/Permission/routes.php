<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Permission', 'namespace' => 'Application'], function () {
        Route::get('permission', ['as' => 'permission', 'uses' => 'PermissionController@index']);
        Route::get('permission/{permission_slug}', ['as' => 'permission.page', 'uses' => 'PermissionController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Permission', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Permission', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('permission', 'PermissionController');
});
