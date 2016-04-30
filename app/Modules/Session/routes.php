<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Session', 'namespace' => 'Application'], function () {
        Route::get('session', ['as' => 'session', 'uses' => 'SessionController@index']);
        Route::get('session/{session_slug}', ['as' => 'session.page', 'uses' => 'SessionController@index']);
        Route::get('session', ['as' => 'session', 'uses' => 'SessionController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Session', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Session', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('session', 'SessionController');
});
