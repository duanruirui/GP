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
Route::get('/test', ['middleware' => 'auth',function(){
	return view('draw.index');
}]);
Route::get('/home', 'HomeController@index')->name('home');
//paied day week month
Route::get('/datas/day', ['middleware' => 'auth', 'uses' => 'StatisticsController@indexDay']);
Route::post('/datas/day', ['middleware' => 'auth', 'uses' => 'StatisticsController@transactionDay']);
Route::get('/datas/week', ['middleware' => 'auth', 'uses' => 'StatisticsController@indexWeek']);
Route::post('/datas/week', ['middleware' => 'auth', 'uses' => 'StatisticsController@transactionWeek']);
Route::get('/datas/month', ['middleware' => 'auth', 'uses' => 'StatisticsController@indexMonth']);
Route::post('/datas/month', ['middleware' => 'auth', 'uses' => 'StatisticsController@transactionMonth']);
//click day week month