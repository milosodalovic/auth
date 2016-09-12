<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

// Authentication Routes
Auth::routes();

// Additional Confirm Registration page route
Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmRegistration');

// Social Authentication Routes
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::get('auth/{provider}/{roleId?}/{invitationCode?}', 'Auth\SocialAuthController@redirectToProvider');

