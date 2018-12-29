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

// Force https schema when a production environment is detected.
if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
