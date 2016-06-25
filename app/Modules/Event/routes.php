<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Event', 'namespace' => 'Application'], function () {
        Route::get('events', ['as' => 'events', 'uses' => 'EventController@list']);
        Route::get('event/{event_slug}', ['as' => 'event.page', 'uses' => 'EventController@index']);
        Route::get('event/{event_slug}/apply', ['as' => 'event.apply', 'uses' => 'EventController@apply']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Event', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Event', 'namespace' => 'Admin', 'middleware' => 'space_manager'], function () {
	Route::resource('event', 'EventController');
});
