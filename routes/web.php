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

$productionMiddlewares = App::isLocal() ? [] : ['verified'];

Auth::routes(['verify' => true]);

Route::group(['middleware' => $productionMiddlewares], function () {
    Route::get('/', 'HomeController@index')->name('home');
});
