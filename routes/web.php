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

Route::get('/', 'HomeController@welcome');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/community', 'TopicsController@index')->name('community');
Route::get('categories/{category_id}')->name('categories');

// 贴子
Route::group([
    'prefix' => 'topics'
], function(){
    Route::get('show/{public_id}', 'TopicsController@show')->name('topic.show');
    Route::get('create', 'TopicsController@create')->name('topic.create');
    Route::post('store', 'TopicsController@store')->name('topic.store');
    Route::get('edit', 'TopicsController@edit')->name('topic.edit');
    Route::put('update', 'TopicsController@update')->name('topic.update');
    Route::delete('delete', 'TopicsController@destroy')->name('topic.delete');
});

// 用户
Route::group([
    'prefix' => 'users'
], function(){
    Route::get('show/{user_id}')->name('user.show');
});
