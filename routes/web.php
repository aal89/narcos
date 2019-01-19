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
$condMiddlewares = App::isLocal() ? array_filter($condMiddlewares, 'notVerified') : $condMiddlewares;

Auth::routes(['verify' => true]);

// The routing group for this application. All controller should reside in this group (except for the Character controller).
Route::group(['middleware' => $condMiddlewares], function () {
    Route::get('/', 'HomeController@index');
});

// Character creation and such is the one state an user can land in when it has an account but no player yet. Therefore
// its the only controller outside the routing group above where all the regular middlewares apply. This is a special case.
Route::get('/character', 'CharacterController@index');
Route::get('/character/create', 'CharacterController@getCreate');
Route::post('/character/create', 'CharacterController@postCreate')->name('character.create');
Route::get('/character/death', 'CharacterController@death');
