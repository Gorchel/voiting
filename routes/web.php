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

Route::get('/', 'HomeController@index');

Route::get('login', ['uses' => 'HomeController@index' ] );
Route::get('register', ['uses' => 'HomeController@index' ] );

Route::post('register', ['uses' => 'HomeController@registration' ] );
Route::post('login', ['as' => 'login', 'uses' => 'HomeController@login' ] );

Route::get('activasion', ['as' => 'activasion', 'uses' => 'HomeController@activasion' ] );

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
	Route::get('logout', [ 'as' => 'logout', 'uses' => 'HomeController@logout' ] );
	Route::post('set_voice', [ 'as' => 'logout', 'uses' => 'HomeController@set_voice' ] );
});
