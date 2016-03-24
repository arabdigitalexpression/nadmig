<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Space', 'namespace' => 'Application'], function () {
        Route::get('space', ['as' => 'space', 'uses' => 'SpaceController@index']);
        Route::get('space/{space_slug}', ['as' => 'space.page', 'uses' => 'SpaceController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Space', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Space', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('space', 'SpaceController');
});
