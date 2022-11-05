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

use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;

 Route::get('/', function () {
     return view('welcome');
 });
 Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');


Route::group(['middleware' => 'auth'], function() {
    //ログイン中のページ
    Route::get('/top','PostsController@index');

    Route::get('/user_profile','PostsController@profile')->name('posts.profile');
    Route::post('/update-profile','PostsController@updateProfile')->name('posts.update-profile');

    Route::post('/search','UsersController@search')->name('users.search');
    Route::get('/search','UsersController@search');

    Route::get('/follow-list','FollowsController@followList');
    Route::get('/follower-list','FollowsController@followerList');

    Route::get('/logout','Auth\LoginController@logout');


    Route::get('/show','FollowsController@show');


    // ツイート関連
    Route::post('/posts', 'PostsController@store')->name('posts.store');
    Route::delete('/delete', 'PostsController@delete');
    Route::post('/update', 'PostsController@update');

    //フォロー・フォロワー関連
    Route::delete('/un_follow/{id}', 'UsersController@unFollow')->name('un_follow');
    Route::post('/follow/{id}', 'UsersController@follow')->name('follow');

    Route::get('/profile/{id}','UsersController@profile')->name('user_profile');


    Route::get('/test', 'PostsController@test');

});
