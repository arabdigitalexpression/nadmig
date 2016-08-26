<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Report', 'namespace' => 'Application'], function () {
        Route::get('report', ['as' => 'report', 'uses' => 'ReportController@index']);
        Route::get('report/{event_slug}', ['as' => 'report.page', 'uses' => 'ReportController@index']);
        Route::get('report/{event_slug}/week/{week}/kid/{attendees_id}', ['as' => 'report.page.event', 'uses' => 'ReportController@report']);
        Route::get('report/{event_slug}/week/{week}/kid/{attendees_id}/show', ['as' => 'report.page.event.show', 'uses' => 'ReportController@show']);
        Route::get('report/{event_slug}/week/{week}/kid/{attendees_id}/edit', ['as' => 'report.page.event.edit', 'uses' => 'ReportController@edit']);
        Route::patch('report/{event_slug}/week/{week}/kid/{attendees_id}/edit', ['as' => 'report.page.event.edit', 'uses' => 'ReportController@update']);
        Route::post('report/{event_slug}/week/{week}/kid/{attendees_id}', ['as' => 'report.page.event.store', 'uses' => 'ReportController@store']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Report', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Report', 'namespace' => 'Admin', 'middleware' => 'space_manager'], function () {
    ////////////////////////////////////
    //// trainer routes /////
    //////////////////////////////////
    Route::get('report/trainer/list', ['as' => 'dashboard.report.trainer', 'uses' => 'ReportController@trainer']);
    Route::get('report/trainer/{report_id}/edit', ['as' => 'dashboard.trainerreport.edit', 'uses' => 'ReportController@trainerEdit']);
    Route::get('report/trainer/{report_id}/del', ['as' => 'dashboard.trainerreport.destroy', 'uses' => 'ReportController@trainerDestroy']);
    Route::get('report/trainer/{report_id}/show', ['as' => 'dashboard.trainerreport.show', 'uses' => 'ReportController@trainerShow']);
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



    ///////////////////////////////////////
    //// Like Dislike Reports routes /////
    /////////////////////////////////////
    Route::get('report/like_dislike/create', ['as' => 'dashboard.report.like_dislike_reports.create', 'uses' => 'ReportController@like_dislike_reports_Create']);
    Route::get('report/like_dislike', ['as' => 'dashboard.likedislike.index', 'uses' => 'ReportController@like_dislike_reports_Index']);
    Route::get('report/like_dislike/list', ['as' => 'dashboard.report.like_dislike_reports.index', 'uses' => 'ReportController@like_dislike_reports_Index']);
    Route::get('report/like_dislike/{report_id}/show', ['as' => 'dashboard.likedislike.show', 'uses' => 'ReportController@like_dislike_reports_Show']);
    Route::get('report/like_dislike/{report_id}/edit', ['as' => 'dashboard.likedislike.edit', 'uses' => 'ReportController@like_dislike_reports_Edit']);
    Route::get('report/like_dislike/{report_id}/destroy', ['as' => 'dashboard.likedislike.destroy', 'uses' => 'ReportController@like_dislike_reports_Destroy']);
    Route::Post('report/like_dislike/store', ['as' => 'dashboard.report.like_dislike_reports.store', 'uses' => 'ReportController@like_dislike_reports_Store']);
    Route::patch('report/like_dislike/{report_id}/update', ['as' => 'dashboard.report.like_dislike_reports.update', 'uses' => 'ReportController@like_dislike_reports_Update']);

    ///////////////////////////////////////
    //// Report 8 Reports routes /////
    /////////////////////////////////////
    Route::get('report/report_8/create', ['as' => 'dashboard.report.report_8.create', 'uses' => 'ReportController@report_8_Create']);
    Route::get('report/report_8', ['as' => 'dashboard.report8.index', 'uses' => 'ReportController@report_8_Index']);
    Route::get('report/report_8/list', ['as' => 'dashboard.report.report_8.index', 'uses' => 'ReportController@report_8_Index']);
    Route::get('report/report_8/{report_id}/show', ['as' => 'dashboard.report8.show', 'uses' => 'ReportController@report_8_Show']);
    Route::get('report/report_8/{report_id}/edit', ['as' => 'dashboard.report8.edit', 'uses' => 'ReportController@report_8_Edit']);
    Route::get('report/report_8/{report_id}/destroy', ['as' => 'dashboard.report8.destroy', 'uses' => 'ReportController@report_8_Destroy']);
    Route::Post('report/report_8/store', ['as' => 'dashboard.report.report_8.store', 'uses' => 'ReportController@report_8_Store']);
    Route::patch('report/report_8/{report_id}/update', ['as' => 'dashboard.report.report_8_.update', 'uses' => 'ReportController@report_8_Update']);

    /////////////////////////
    //// Export Routes /////
    ///////////////////////
    Route::get('report/export', ['as' => 'dashboard.report.export.index', 'uses' => 'ReportController@export_page']);
    // export all
    Route::get('report/{model_name}/export/{period}', ['as' => 'dashboard.report.export.all', 'uses' => 'ReportController@export']);
    // within a period
    Route::get('report/{model_name}/export/{period}/from/{from_date}/to/{to_date}', ['as' => 'dashboard.report.export', 'uses' => 'ReportController@export']);
	Route::resource('report', 'ReportController');
});
