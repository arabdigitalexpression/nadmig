<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Trainer', 'namespace' => 'Application'], function () {
        Route::get('trainer', ['as' => 'trainer', 'uses' => 'TrainerController@index']);
        Route::get('trainer/{trainer_slug}', ['as' => 'trainer.page', 'uses' => 'TrainerController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Trainer', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'admin', 'module' => 'Trainer', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('trainer', 'TrainerController');
});
