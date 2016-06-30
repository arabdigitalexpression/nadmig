<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'SummerSchool', 'namespace' => 'Application'], function () {
        Route::get('summerschool', ['as' => 'summerschool', 'uses' => 'SummerSchoolController@index']);
        Route::get('summerschool/{summerschool_slug}', ['as' => 'summerschool.page', 'uses' => 'SummerSchoolController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'SummerSchool', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'admin', 'module' => 'SummerSchool', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('summerschool', 'SummerSchoolController');
});
