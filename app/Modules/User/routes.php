<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'User', 'namespace' => 'Application'], function () {
        Route::get('user/register', ['as' => 'application.user.create', 'uses' => 'UserController@create']);
        Route::get('user/edit', ['as' => 'application.user.edit', 'uses' => 'UserController@edit']);
        Route::post('user/store', ['as' => 'application.user.store', 'uses' => 'UserController@store']);
        Route::patch('user/update', ['as' => 'application.user.update', 'uses' => 'UserController@update']);
        Route::get('user/verify/{confirmationCode}', ['as' => 'application.user.verify','uses' => 'UserController@confirm']);
        Route::get('user', ['as' => 'application.user.index', 'uses' => 'UserController@index']);
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
