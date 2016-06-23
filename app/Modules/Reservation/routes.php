<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Reservation', 'namespace' => 'Application'], function () {
        Route::get('reservation', ['as' => 'reservation', 'uses' => 'ReservationController@list']);
        Route::get('organization/{organization_slug}/reserve', ['as' => 'reservation.create', 'uses' => 'ReservationController@create']);
        Route::post('organization/{organization_slug}/reservation/store', ['as' => 'application.reservation.store', 'uses' => 'ReservationController@store']);
        Route::get('reservation/{reservation_url_id}/edit', ['as' => 'application.reservation.edit', 'uses' => 'ReservationController@edit']);
        Route::patch('reservation/{reservation_url_id}/update', ['as' => 'application.reservation.update', 'uses' => 'ReservationController@update']);
        Route::get('reservation/{reservation_url_id}/delete', ['as' => 'application.reservation.del', 'uses' => 'ReservationController@delete']);
        Route::get('reservation/{reservation_url_id}', ['as' => 'application.reservation.index', 'uses' => 'ReservationController@index']);
        Route::get('reservation/{reservation_url_id}/accept', ['as' => 'application.reservation.accept', 'uses' => 'ReservationController@accept']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Reservation', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Reservation', 'namespace' => 'Admin', 'middleware' => 'space_manager'], function () {
	Route::resource('reservation', 'ReservationController');

});
