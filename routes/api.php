<?php

use Illuminate\Http\Request;
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

Route::get('feeds', 'FeedController@index');
Route::get('feeds/{feed}', 'FeedController@show');
Route::post('feeds', 'FeedController@store');
Route::put('feeds/{feed}', 'FeedController@update');
Route::delete('feeds/{feed}', 'FeedController@delete');

Route::get('posts', 'PostController@index');
Route::get('posts/{post}', 'PostController@show');
Route::get('posts/{feed}/all', 'PostController@showFeedPosts');
Route::post('posts', 'PostController@storeRequest');
Route::put('posts/{post}', 'PostController@update');
Route::delete('posts/{post}', 'PostController@delete');
