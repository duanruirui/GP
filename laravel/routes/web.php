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
Route::get('/', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::get('/test', function(){
	return view('draw.index');
});
Route::get('/home', 'HomeController@index')->name('home');
