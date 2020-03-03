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

Route::get('/', 'PostsController@index');
Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/
Route::get('/home', 'PostsController@index');


//----------- UsersController ------------//
// user profile edit page
Route::get('/users/edit', 'UsersController@edit');
// user update page
Route::post('/users/update', 'UsersController@update');
// userpage
Route::get('/users/{user_id}', 'UsersController@show');


//----------- PostsController ------------//
// display new post page
Route::get('/posts/new', 'PostsController@new')->name('new');
// store new post
Route::post('/posts','PostsController@store');
//
////// <----------------------------------> //////////
Route::get('/posts/{post_id}/', 'PostsController@show');
////// <----------------------------------> //////////
// delete a post
Route::get('/postsdelete/{post_id}', 'PostsController@destroy');


//------------ LikesController ----------//
// Like
Route::get('/posts/{post_id}/likes', 'LikesController@store');
// Like Destroy
Route::get('/likes/{like_id}', 'LikesController@destroy');


//----------- CommentsController -----------//
// Comment
Route::post('/posts/{comment_id}/comments','CommentsController@store');
// Comment Destroy
Route::get('/comments/{comment_id}', 'CommentsController@destroy');


//----------- follower following -----------//
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::group(['prefix' => 'users/{id}'], function () { 
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
    });

    Route::resource('posts', 'PostsController', ['only' => ['store', 'destroy']]);
});