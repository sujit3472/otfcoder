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
	##Route for dashboard
	Route::get('admin/dashboard', 'HomeController@index')->name('home');
	
	##Route for user
	Route::resource('user', 'backend\UserController');
	Route::get('user/{id}/delete', 'backend\UserController@destroy');

	##Route for role
	Route::resource('roles', 'backend\RoleController');
	
	## Route For Common status change
	Route::any('changestatus', 'HomeController@fn_change_status');

	Route::any('changepassword/{id}', 'HomeController@fn_change_passsword');
	Route::get('changepassword', function () {
		return view('change-password');
	});
});

## middleware for admin access
Route::group(['middleware' => 'CheckUserAccess'], function () { 
	##Route for user dashboard
	Route::get('/user-home', 'HomeController@fn_user_home');
	
	##Route for profile and update profile
	Route::get('profile', 'ProfileController@edit'); 
	Route::patch('profile/{id}', 'ProfileController@update');
});
