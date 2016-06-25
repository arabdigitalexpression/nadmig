<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Session', 'namespace' => 'Application'], function () {
        Route::get('session', ['as' => 'session', 'uses' => 'SessionController@index']);
        Route::get('session/{session_slug}', ['as' => 'session.page', 'uses' => 'SessionController@index']);
        Route::get('event/{event_slug}/session/{session_slug}', ['as' => 'session.show', 'uses' => 'SessionController@show']);
        Route::get('session/{session_slug}/accept', ['as' => 'session.accept', 'uses' => 'SessionController@accept']);
        Route::get('session', ['as' => 'session', 'uses' => 'SessionController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Session', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Session', 'namespace' => 'Admin', 'middleware' => 'space_manager'], function () {
	Route::resource('session', 'SessionController');
});
