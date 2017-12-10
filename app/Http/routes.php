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

Route::get('/','HomeController@index');

Route::get('/category_id/{category_id}','HomeController@index');//根据live分类查找

Route::resource('user','UserController');//资源路由

Route::resource('live','LiveController');

Route::get('login','LoginController@create')->name("login");

Route::post('login','LoginController@store')->name("login");

Route::delete('logout','LoginController@destroy')->name("logout");

Route::get('test/create','TestController@create')->name('create');

Route::post('follow/follow/{id}','FollowController@store')->name('follow.follow');

Route::delete('follow/unfollow/{id}','FollowController@destroy')->name('follow.unfollow');