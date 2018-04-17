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

Route::get('/', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::get('main', ['middleware' => 'auth', 'uses' => 'MainController@mainIndex']);
Route::get('index', ['middleware' => 'auth', 'uses' => 'MainController@Index']);
//管理员登陆和退出登陆
Route::get('login','Auth\AuthController@getLogin');
Route::post('login','Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');

//角色管理
Route::get('group', ['middleware' => 'auth', 'uses' => 'GroupController@groupIndex']);
Route::get('group/edit/{id}', ['middleware' => 'auth', 'uses' => 'GroupController@groupEdit'])->where('id', '[0-9]+');
Route::post('group/edit/{id}', ['middleware' => 'auth', 'uses' => 'GroupController@PostEdit'])->where('id', '[0-9]+');
Route::get('group/add', ['middleware' => 'auth', 'uses' => 'GroupController@addGet']);
Route::post('group/add', ['middleware' => 'auth', 'uses' =>'GroupController@addPost']);
Route::get('group/delete/{id}', ['middleware' => 'auth', 'uses' => 'GroupController@delete'])->where('id', '[0-9]+');

//后台用户管理
Route::get('user', ['middleware' => 'auth', 'uses' => 'UserController@userIndex']);
Route::get('user/edit/{id}', ['middleware' => 'auth', 'uses' => 'UserController@userEdit'])->where('id', '[0-9]+');
Route::post('user/edit/{id}', ['middleware' => 'auth', 'uses' => 'UserController@PostEdit'])->where('id', '[0-9]+');
Route::get('user/add', ['middleware' => 'auth', 'uses' => 'UserController@addGet']);
Route::post('user/add', ['middleware' => 'auth', 'uses' =>'UserController@addPost']);
Route::get('user/delete/{id}', ['middleware' => 'auth', 'uses' => 'UserController@delete'])->where('id', '[0-9]+');

//权限管理
Route::get('action', ['middleware' => 'auth', 'uses' => 'ActionController@actionIndex']);
Route::get('action/edit/{id}', ['middleware' => 'auth', 'uses' => 'ActionController@actionEdit'])->where('id', '[0-9]+');
Route::post('action/edit/{id}', ['middleware' => 'auth', 'uses' => 'ActionController@PostEdit'])->where('id', '[0-9]+');
Route::get('action/add', ['middleware' => 'auth', 'uses' => 'ActionController@addGet']);
Route::post('action/add', ['middleware' => 'auth', 'uses' =>'ActionController@addPost']);
Route::get('action/delete/{id}', ['middleware' => 'auth', 'uses' => 'ActionController@delete'])->where('id', '[0-9]+');

//菜单管理
Route::get('menu',  ['middleware' => 'auth', 'uses' => 'MenuController@menuIndex']);
Route::get('menu/edit/{id}', ['middleware' => 'auth', 'uses' => 'MenuController@menuEdit'])->where('id', '[0-9]+');
Route::post('menu/edit/{id}', ['middleware' => 'auth', 'uses' => 'MenuController@PostEdit'])->where('id', '[0-9]+');
Route::get('menu/add', ['middleware' => 'auth', 'uses' => 'MenuController@addGet']);
Route::post('menu/add', ['middleware' => 'auth', 'uses' =>'MenuController@addPost']);
Route::get('menu/delete/{id}', ['middleware' => 'auth', 'uses' => 'MenuController@delete'])->where('id', '[0-9]+');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
