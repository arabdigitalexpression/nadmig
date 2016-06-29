<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Program', 'namespace' => 'Application'], function () {
        Route::get('programs', ['as' => 'program', 'uses' => 'ProgramController@list']);
        Route::get('program/{program_slug}', ['as' => 'program.page', 'uses' => 'ProgramController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Program', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Program', 'namespace' => 'Admin', 'middleware' => 'organization_manager'], function () {
	Route::resource('program', 'ProgramController');
});
