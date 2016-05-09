<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Reservation', 'namespace' => 'Application'], function () {
        Route::get('reservation', ['as' => 'reservation', 'uses' => 'ReservationController@list']);
        Route::get('space/{space_slug}/reserve', ['as' => 'reservation.create', 'uses' => 'ReservationController@create']);
        Route::post('space/{space_slug}/reservation/store', ['as' => 'application.reservation.store', 'uses' => 'ReservationController@store']);
        Route::get('reservation/{reservation_url_id}/edit', ['as' => 'application.reservation.edit', 'uses' => 'ReservationController@edit']);
        Route::patch('reservation/{reservation_url_id}/update', ['as' => 'application.reservation.update', 'uses' => 'ReservationController@update']);
        Route::get('reservation/{reservation_url_id}/delete', ['as' => 'application.reservation.del', 'uses' => 'ReservationController@delete']);
        Route::get('reservation/{reservation_url_id}', ['as' => 'application.reservation.index', 'uses' => 'ReservationController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Reservation', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Reservation', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('reservation', 'ReservationController');
});
