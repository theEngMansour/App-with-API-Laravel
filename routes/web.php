<?php

use Illuminate\Support\Facades\Route;

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



//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('posts', 'PostController');
Route::resource('comments', 'CommentController');
Route::resource('like', 'LikeController');
Route::resource('unlike', 'UnlikeController');
Route::get('search','PostController@search');
Route::get('/posts/{year}/{month}', 'PostController@archive');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('follow', 'followController');
});



