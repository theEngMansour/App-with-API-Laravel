<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(['prefix' => '/v1','middleware' => 'auth.basic.once'], function () {
    
Route::group(['prefix' => '/v1'], function () {
    
    // Post : Add Post , Delete Post , Edit Posts and Display Post
    Route::apiresource('posts', 'API\PostController');
    // User : 
    Route::apiresource('users', 'API\UserController');
    // Comment : Add Comment , Delete Comment , Edit Comment and Display Comment
    Route::apiresource('comments', 'API\CommentController');
    // Relationshaip Between: Users & Posts
    Route::get('users/{id}/posts', 'API\RelationshaipController@userPosts');
    // Relationshaip Between: Posts & Comments
    Route::get('posts/{id}/comments', 'API\RelationshaipController@postComments');
    // Login by Passport
    Route::get('login', 'API\LoginController@login')->name('login');
});
