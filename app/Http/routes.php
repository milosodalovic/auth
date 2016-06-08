<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    // Authentication Routes...
    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    // Additional Confirm Registration page route
    Route::get('/register/confirm/{token}', 'Auth\AuthController@confirmRegistration');

    // oAuth routes
    Route::get('google', 'Auth\AuthController@redirectToProvider');
    Route::get('google/callback', 'Auth\AuthController@handleProviderCallback');

    // Pages
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index');
});
