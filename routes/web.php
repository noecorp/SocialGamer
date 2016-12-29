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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/search', 'SearchUsersController@users');

Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store', 'destroy']]);

Route::get('/user-avatar/{id}/{size}', 'ImagesController@user_avatar');

Route::resource('/friends', 'FriendsController', ['except' => ['create', 'edit', 'show']]);
