<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Space', 'namespace' => 'Application'], function () {
        Route::get('spaces', ['as' => 'spaces', 'uses' => 'SpaceController@index']);
        Route::get('space/{space_slug}', ['as' => 'space.page', 'uses' => 'SpaceController@space']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Space', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    // get fees and time for the space
     Route::get('space/{space}', ['as' => 'space.fees_time', 'uses' => 'SpaceController@retrive']);
     Route::get('space/{space}/{year}/{month}/{day}', ['as' => 'space.date', 'uses' => 'SpaceController@date']);
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Space', 'namespace' => 'Admin', 'middleware' => 'space_manager'], function () {
	Route::resource('space', 'SpaceController');

});
