<?php

Route::group(['middleware' => 'web'], function () {
   
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Role', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'admin', 'module' => 'Role', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('role', 'RoleController');
});
