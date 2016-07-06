<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Attendees', 'namespace' => 'Application'], function () {
        Route::get('school/attendees/regisater', ['as' => 'application.attendees.create', 'uses' => 'AttendeesController@create']);
        Route::post('school/attendees/regisater', ['as' => 'application.attendees.store', 'uses' => 'AttendeesController@store']);
        Route::get('attendees/{attendees_slug}', ['as' => 'attendees.page', 'uses' => 'AttendeesController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Attendees', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Attendees', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('attendees', 'AttendeesController');
});
