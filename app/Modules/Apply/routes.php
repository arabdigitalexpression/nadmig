<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Apply', 'namespace' => 'Application'], function () {
        // Route::get('event/{event_slug}/apply', ['as' => 'apply.apply', 'uses' => 'ApplyController@apply']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Apply', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Apply', 'namespace' => 'Admin', 'middleware' => 'space_manager'], function () {
	Route::resource('apply', 'ApplyController');
});
