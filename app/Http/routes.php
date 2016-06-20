<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['namespace' => 'Application'], function () {
        Route::get('/', ['as' => 'root', 'uses' => 'HomeController@index']);
        Route::get('page/{page_slug}', ['as' => 'page', 'uses' => 'PageController@index']);
        Route::post('language/change', ['as' => 'app.language.change' , 'uses' => 'LanguageController@postChange']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    // GET
    Route::get('/', ['as' => 'dashboard.root', 'uses' => 'DashboardController@getIndex']);
    Route::get('setting', ['as' => 'dashboard.setting.index', 'uses' => 'SettingController@getSettings']);
    // POST
    Route::post('language/change', ['as' => 'dashboard.language.change' , 'uses' => 'LanguageController@postChange']);
    Route::post('page/order', ['as' => 'dashboard.page.order' , 'uses' => 'PageController@postOrder']);
    // PATCH
    Route::patch('setting/{setting}', ['as' => 'dashboard.setting.update', 'uses' => 'SettingController@patchSettings']);
    // Resources
    Route::resource('language', 'LanguageController');
    Route::resource('page', 'PageController');
});
// // organization_manager routes
Route::group(['prefix' => 'dashboard', 'namespace' => 'Admin', 'middleware' => 'organization_manager'], function () {
    // GET
    Route::get('/', ['as' => 'dashboard.root', 'uses' => 'DashboardController@getIndex']);
});
