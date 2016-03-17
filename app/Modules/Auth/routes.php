<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Auth', 'namespace' => 'Application'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::get('/', ['as' => 'auth.root', 'uses' => 'AuthController@getLogin']);
            Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
            Route::post('login', ['as' => 'auth.login', 'uses' => 'AuthController@postLogin']);
            Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);
        });
        Route::group(['prefix' => 'password'], function () {
            Route::get('email', ['as' => 'password.email', 'uses' => 'PasswordController@getEmail']);
            Route::post('email', ['as' => 'password.email', 'uses' => 'PasswordController@postEmail']);
            Route::get('reset/{token?}', ['as' => 'password.reset', 'uses' => 'PasswordController@showResetForm']);
            Route::post('reset', ['as' => 'password.reset', 'uses' => 'PasswordController@postReset']);
        });
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Auth', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Auth', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('auth', 'AuthController');
});
