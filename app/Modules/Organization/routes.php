<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Organization', 'namespace' => 'Application'], function () {
        Route::get('organization', ['as' => 'organization', 'uses' => 'OrganizationController@index']);
        Route::get('organization/{organization_slug}', ['as' => 'organization.page', 'uses' => 'OrganizationController@index']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Organization', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Organization', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('organization', 'OrganizationController');
});
// Orgnization Manager
Route::group(['prefix' => 'dashboard', 'module' => 'Organization', 'namespace' => 'Admin', 'middleware' => 'organization_manager'], function () {
	Route::get('my_organization', ['as' => 'dashboard.organization.mine.show', 'uses' => 'OrganizationController@showMyOrg']);
});

