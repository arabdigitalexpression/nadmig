<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Attendees', 'namespace' => 'Application'], function () {
        Route::get('school/attendees/register', ['as' => 'application.attendees.create', 'uses' => 'AttendeesController@create']);
        Route::post('school/attendees/register', ['as' => 'application.attendees.store', 'uses' => 'AttendeesController@store']);
        Route::get('attendees/{attendees_slug}', ['as' => 'attendees.page', 'uses' => 'AttendeesController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Attendees', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Attendees', 'namespace' => 'Admin', 'middleware' => 'organization_manager'], function () {
	Route::resource('attendees', 'AttendeesController');

    /////////////////////////
    //// Export Routes /////
    ///////////////////////
    // Route::get('attendees/export', ['as' => 'dashboard.attendees.export.index', 'uses' => 'AttendeesController@export_page']);
    // export all
    Route::get('attendees/{selector_key}/{selector_value}/export/{period}', ['as' => 'dashboard.attendees.export.all', 'uses' => 'AttendeesController@export']);
    // within a period
    Route::get('attendees/{selector}/export/{period}/from/{from_date}/to/{to_date}', ['as' => 'dashboard.attendees.export', 'uses' => 'AttendeesController@export']);
	


});
