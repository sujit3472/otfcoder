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
## Image upload ajax 
Route::any('/uploadimages', 'ImageMediaController@fn_uploadimages');
Route::any('/delete-image', 'ImageMediaController@fn_removeimage');

##Verify User
Route::any('verify-user/{slug?}', 'Auth\RegisterController@fn_verify_user');


Auth::routes();


Route::get('/home', function() 
{
	if(Auth::check()) {
		$intRole = Auth::user()->role_id;
		switch ($intRole) {
			case 1:
				return redirect('admin/dashboard');
			case 2:
				return redirect('/user-home');
		}
	} else {
   		Flash::error('You are already registerd user.');
   		return redirect('/');
   	}
});
## middleware for admin access
Route::group(['middleware' => 'CheckAdminAccess'], function () { 
	Route::get('admin/dashboard', 'HomeController@index')->name('home');
	Route::resource('user', 'backend\UserController');
	Route::get('user/{id}/delete', 'backend\UserController@destroy');

});

## middleware for admin access
Route::group(['middleware' => 'CheckUserAccess'], function () { 
	// Route::resource('profile', 'backend\UserController');
	Route::get('/user-home', 'HomeController@fn_user_home');
	Route::get('profile', 'ProfileController@edit'); 
	Route::patch('profile/{id}', 'ProfileController@update');

});
