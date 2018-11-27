<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

/**
 * Socialite Auth Routes
 */

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'TweetsController@index');

    /**
     * Tweets related routes
     */

    Route::post('tweet/create', 'TweetsController@store');

    /**
     * User related routes
     */

    Route::get('user/{name}', 'UsersController@show');

});
