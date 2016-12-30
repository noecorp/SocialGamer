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

//Homepage
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Login page
Route::get('/home', 'HomeController@index');

//Search Users
Route::get('/search', 'SearchUsersController@users');

//Users
Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store', 'destroy']]);

//Get specific image
Route::get('/user-avatar/{id}/{size}', 'ImagesController@user_avatar');

//Friendship
Route::get('/users/{user}/friends', 'FriendsController@index');
Route::post('/friends/{friend}', 'FriendsController@add');
Route::patch('/friends/{friend}', 'FriendsController@accept');
Route::delete('/friends/{friend}', 'FriendsController@destroy');