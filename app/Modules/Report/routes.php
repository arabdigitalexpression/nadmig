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
Route::group(['prefix' => 'dashboard', 'module' => 'Report', 'namespace' => 'Admin', 'middleware' => 'space_manager'], function () {
    Route::get('report/trainer', ['as' => 'dashboard.report.trainer', 'uses' => 'ReportController@trainer']);

    Route::get('report/trainer/{id}/show', ['as' => 'dashboard.trainerreport.show', 'uses' => 'ReportController@trainerShow']);
    ////////////////////////////////////
    //// Space manage 2 routes /////
    //////////////////////////////////
    Route::get('report/space_manger_2/create', ['as' => 'dashboard.report.space_manger_2.create', 'uses' => 'ReportController@space_manger_2Create']);
    Route::get('report/space_manger_2', ['as' => 'dashboard.spacemanager2report.index', 'uses' => 'ReportController@space_manger_2Index']);
    Route::get('report/space_manger_2/list', ['as' => 'dashboard.report.space_manger_2.index', 'uses' => 'ReportController@space_manger_2Index']);
    Route::get('report/space_manger_2/{report_id}/show', ['as' => 'dashboard.spacemanager2report.show', 'uses' => 'ReportController@space_manger_2Show']);
    Route::get('report/space_manger_2/{report_id}/edit', ['as' => 'dashboard.spacemanager2report.edit', 'uses' => 'ReportController@space_manger_2Edit']);
    Route::get('report/space_manger_2/{report_id}/destroy', ['as' => 'dashboard.spacemanager2report.destroy', 'uses' => 'ReportController@space_manger_2Destroy']);
    Route::Post('report/space_manger_2/store', ['as' => 'dashboard.report.space_manger_2.store', 'uses' => 'ReportController@space_manger_2Store']);
    Route::patch('report/space_manger_2/{report_id}/update', ['as' => 'dashboard.report.space_manger_2.update', 'uses' => 'ReportController@space_manger_2Update']);

	Route::resource('report', 'ReportController');
});
