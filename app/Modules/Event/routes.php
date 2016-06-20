<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Event', 'namespace' => 'Application'], function () {
        Route::get('event', ['as' => 'event', 'uses' => 'EventController@index']);
        Route::get('event/{event_slug}', ['as' => 'event.page', 'uses' => 'EventController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Event', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Event', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('event', 'EventController');
});
