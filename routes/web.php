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

Route::get('/', 'StatusController@index');

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
Route::get('/home', 'StatusController@my') -> middleware('verified') -> name('homw');

// 获取特定用户的动态
Route::get('status/show/{user_id}', 'StatusController@show') -> name('status_show');

// 显示当前用户动态
Route::get('status', 'StatusController@my') -> middleware('verified') -> name('my_statuses');

// 显示所有动态
Route::get('status/show', 'StatusController@index');

// 发布动态
Route::post('status/store', 'StatusController@store') -> middleware('verified') -> name('status_store');

// 删除动态
Route::get('status/delete/{statuses_id}','StatusController@destroy') -> middleware('verified') -> name('status_delete');

// 粉丝页面
Route::get('fans/show/{user_id}', 'FollowerController@fans') -> name('fans_show');
// 关注页面
Route::get('focus/show/{user_id}', 'FollowerController@focus') -> name('focus_show');

// 关注
Route::get('onfocus/{user_id}', 'FollowerController@onFocus') -> middleware('verified') -> name('onfocus');
// 取消关注
Route::get('offfocus/{user_id}', 'FollowerController@offFocus') -> middleware('verified') -> name('offfocus');
