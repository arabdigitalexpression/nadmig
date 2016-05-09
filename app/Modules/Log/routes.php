<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Log', 'namespace' => 'Application'], function () {
        Route::get('log', ['as' => 'log', 'uses' => 'LogController@index']);
        Route::get('log/{log_slug}', ['as' => 'log.page', 'uses' => 'LogController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Log', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'admin', 'module' => 'Log', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('log', 'LogController');
});
