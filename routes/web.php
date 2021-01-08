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
Auth::routes();

Route::get('/','FrontOffreController@index')->name('home')->middleware('auth');

Route::get('home', function () { 
	return view('profile.edit');
})->name('home');

Route::get('/back', 'offreController@index')->name('back')->middleware('auth');
Route::get('/nos-offres','FrontOffreController@index')->name('les-offres');
Route::get('/offre','offreController@offre')->name('front.offre');


Route::delete('offres/{id}', 'offreController@destroy');
Route::delete('offres-deleteselection', 'offreController@deleteAll');
Route::delete('users-deleteselection', 'UserController@deleteAll');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::resource('roles','RoleController');
	Route::resource('offres','offreController');
	Route::resource('front','FrontOffreController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


