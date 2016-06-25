<?php


// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Log', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('log', 'LogController');
});
