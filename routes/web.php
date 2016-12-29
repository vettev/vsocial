<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/logout', function() {
	Auth::logout();
	return redirect()->route('home');
})->name('logout');

Route::get('/', [
	'uses' => 'MainController@index',
	'as' => 'home'
	]);

Route::post('/post-new', [
	'uses' => 'PostController@new',
	'as' => 'post.new',
	'middleware' => 'auth'
	]);

Route::post('/post/like', [
	'uses' => 'PostController@like',
	'as' => 'post.like',
	'middleware' => 'auth'
	]);

Route::get('/post/{id}/delete', [
	'uses' => 'PostController@delete',
	'as' => 'post.delete',
	'middleware' => 'auth'
	]);

Route::get('/post/{id}/edit', [
	'uses' => 'PostController@edit',
	'as' => 'post.edit',
	'middleware' => 'auth'
	]);

Route::get('/post/{id}/reactions', [
	'uses' => 'PostController@reactions',
	'as' => 'post.reactions'
	]);

Route::get('/post/{id}/comment-new', [
	'uses' => 'CommentController@commentNew',
	'as' => 'comment.new',
	'middleware' => 'auth'
	]);

Route::get('/user/{id}/show', [
	'uses' => 'UserController@show',
	'as' => 'user.show'
	]);

Route::get('/user/account', [
	'uses' => 'UserController@account',
	'as' => 'user.account',
	'middleware' => 'auth'
	]);

Route::post('/user/account/save', [
	'uses' => 'UserController@accountSave',
	'as' => 'user.account.save',
	'middleware' => 'auth'
	]);

Route::get('/user/{id}/posts/{page?}', [
	'uses' => 'UserController@userPosts',
	'as' => 'user.posts'
]);

Route::get('/user/{id}/add-friend', [
	'uses' => 'UserController@friendRequest',
	'as' => 'friend.request',
	'middleware' => 'auth'
	]);

Route::get('/user/{id}/accept-friend', [
	'uses' => 'UserController@acceptFriend',
	'as' => 'friend.accept',
	'middleware' => 'auth'
	]);

Route::get('/user/{id}/deny-friend', [
	'uses' => 'UserController@denyFriend',
	'as' => 'friend.deny',
	'middleware' => 'auth'
	]);

Route::get('/user/{id}/friend-requests', [
	'uses' => 'UserController@friendRequests',
	'as' => 'friend.requests',
	'middleware' => 'auth'
	]);

Route::post('/search', [
	'uses' => 'MainController@search',
	'as' => 'search',
	'middleware' => 'auth'
	]);

Route::post('/pusher/auth', [
	'uses' => 'MainController@pusherAuth',
	'as' => 'pusher.auth'
]);

Route::get("/posts/load/{page?}", [
	'uses' => 'PostController@showPosts',
	'as' => 'posts.load',
	'middleware' => 'auth'
]);

Auth::routes();

