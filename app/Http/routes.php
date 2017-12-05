<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('index', 'UserController@index');
//
//Route::get('login', 'UserController@login');
//
//Route::get('create', 'UserController@create');

Route::resource('user','UserController');

Route::get('login','LoginController@create')->name("login");

Route::post('login','LoginController@store')->name("login");

Route::delete('logout','LoginController@destroy')->name("logout");