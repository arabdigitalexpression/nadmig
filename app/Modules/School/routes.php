<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'School', 'namespace' => 'Application'], function () {
        Route::get('schools', ['as' => 'schools', 'uses' => 'SchoolController@index']);
        Route::get('school/{school_slug}', ['as' => 'school.page', 'uses' => 'SchoolController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'School', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'School', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('school', 'SchoolController');
});
