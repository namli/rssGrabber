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
Route::get('feeds/{id}', 'FeedController@show');
Route::get('feeds/{id}/all', 'PostController@showFeedPosts');
Route::post('feeds', 'FeedController@store');
Route::put('feeds/{id}', 'FeedController@update');
Route::delete('feeds/{id}', 'FeedController@delete');

Route::get('posts', 'PostController@index');
Route::get('posts/{id}', 'PostController@show');
Route::post('posts', 'PostController@storeRequest');
Route::put('posts/{id}', 'PostController@update');
Route::delete('posts/{id}', 'PostController@delete');
