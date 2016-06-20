<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'User', 'namespace' => 'Application'], function () {
        Route::get('user/register', ['as' => 'application.user.create', 'uses' => 'UserController@create']);
        Route::post('user/store', ['as' => 'application.user.store', 'uses' => 'UserController@store']);
        Route::get('user/verify/{confirmationCode}', ['as' => 'application.user.verify','uses' => 'UserController@confirm']);
        // Route::get('user/{user_slug}', ['as' => 'user.page', 'uses' => 'UserController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'User', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'User', 'namespace' => 'Admin', 'middleware' => ['admin']], function () {
	Route::resource('user', 'UserController');
});
