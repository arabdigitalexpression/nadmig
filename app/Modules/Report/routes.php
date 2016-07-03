<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Report', 'namespace' => 'Application'], function () {
        Route::get('report', ['as' => 'report', 'uses' => 'ReportController@index']);
        Route::get('report/{report_slug}', ['as' => 'report.page', 'uses' => 'ReportController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Report', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'admin', 'module' => 'Report', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('report', 'ReportController');
});
