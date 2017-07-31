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

Route::group([
    'prefix' => 'topics'
], function(){
    Route::get('show/{public_id}', 'TopicsController@show')->name('topic.show');
});

Route::group([
    'prefix' => 'users'
], function(){
    Route::get('show/{user_id}')->name('user.show');
});
