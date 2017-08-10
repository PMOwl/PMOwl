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
    'prefix' => 'socialite'
], function () {
    Route::get('auth', 'Auth\SocialiteController@auth');
    Route::get('callback', 'Auth\SocialiteController@callBack');
    Route::get('create-confirm', 'Auth\SocialiteController@createSocialiteView')->name('socialite.signUpView');
    Route::post('create-confirm', 'Auth\SocialiteController@createNewUser')->name('socialite.signUp');
});

// 贴子
Route::group([
    'prefix' => 'topics'
], function () {
    Route::get('show/{public_id}', 'TopicsController@show')->name('topic.show');
    Route::get('create', 'TopicsController@create')->name('topic.create');
    Route::post('store', 'TopicsController@store')->name('topic.store');
    Route::get('{public_id}/edit', 'TopicsController@edit')->name('topic.edit');
    Route::put('{public_id}/update', 'TopicsController@update')->name('topic.update');
    Route::delete('{public_id}/delete', 'TopicsController@destroy')->name('topic.delete');
});

// 用户
Route::group([
    'prefix' => 'users'
], function () {
    Route::get('show/{user_id}')->name('user.show');
});
