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
    Route::auth();

    // Additional Confirm Registration page route
    $this->get('confirm-account', 'Auth\AuthController@getConfirmRegistration');

    // Pages
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index');
});
