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

$condMiddlewares = ['auth', 'verified', 'user.has.character'];

Auth::routes(['verify' => true]);

Route::group(['middleware' => array_filter($condMiddlewares, 'notVerifiedWhenLocal')], function () {
    Route::get('/', 'HomeController@index')->name('home');
});

Route::get('/character/create', 'CharacterController@index');
