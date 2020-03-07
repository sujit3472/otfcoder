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

Route::get('/home', 'HomeController@index')->name('home');

## middleware for admin access
Route::group(['middleware' => 'CheckAdminAccess'], function () { 
	Route::resource('user', 'backend\UserController');
	Route::get('user/{id}/delete', 'backend\UserController@destroy');

	## Image upload ajax 
	Route::any('/uploadimages', 'ImageMediaController@fn_uploadimages');
	Route::any('/delete-image', 'ImageMediaController@fn_removeimage');
});
