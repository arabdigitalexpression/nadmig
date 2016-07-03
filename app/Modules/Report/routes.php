<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Report', 'namespace' => 'Application'], function () {
        Route::get('report', ['as' => 'report', 'uses' => 'ReportController@index']);
        Route::get('report/{event_slug}', ['as' => 'report.page', 'uses' => 'ReportController@index']);
        Route::get('report/{event_slug}/week/{week}/kid/{user_id}', ['as' => 'report.page.event', 'uses' => 'ReportController@report']);
        Route::get('report/{event_slug}/week/{week}/kid/{user_id}/show', ['as' => 'report.page.event.show', 'uses' => 'ReportController@show']);
        Route::get('report/{event_slug}/week/{week}/kid/{user_id}/edit', ['as' => 'report.page.event.edit', 'uses' => 'ReportController@edit']);
        Route::patch('report/{event_slug}/week/{week}/kid/{user_id}/edit', ['as' => 'report.page.event.edit', 'uses' => 'ReportController@update']);
        Route::post('report/{event_slug}/week/{week}/kid/{user_id}', ['as' => 'report.page.event.store', 'uses' => 'ReportController@store']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Report', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Report', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('report/trainer', ['as' => 'dashboard.report.trainer', 'uses' => 'ReportController@trainer']);
    Route::get('report/trainer/{id}/show', ['as' => 'dashboard.trainerreport.show', 'uses' => 'ReportController@trainerShow']);
	Route::resource('report', 'ReportController');
});
