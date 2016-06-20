<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Organization', 'namespace' => 'Application'], function () {
        Route::get('organization', ['as' => 'organization', 'uses' => 'OrganizationController@index']);
        Route::get('organization/{organization_slug}', ['as' => 'organization.page', 'uses' => 'OrganizationController@organization']);
    });



});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Organization', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Organization', 'namespace' => 'Admin', 'middleware' => ['organization_manager']], function () {
		Route::get('organization/mine', ['as' => 'dashboard.organization.mine.show', 'uses' => 'OrganizationController@showMyOrg']);
		Route::resource('organization', 'OrganizationController');

	});