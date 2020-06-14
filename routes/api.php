<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UsersCollection;
use App\Models\User;

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

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

//api group middleware
Route::group(['middleware' => 'auth:api'], function(){

// current user
Route::get('user', 'Api\UserController@details');
Route::post('userDetail/{userId}', 'Api\UserDetailController@store');
Route::post('uploadProfilePicture/{userId}', 'Api\UserDetailController@uploadProfilePicture');


// user follow
Route::get('user_follow/{leaderId}/{followerId}', 'Api\UserFollowController@followUser');
Route::get('user_unfollow/{leaderId}/{followerId}', 'Api\UserFollowController@unfollowUser');
Route::get('check_user_follow/{leaderId}/{followerId}', 'Api\UserFollowController@checkUserFollow');




// tags
Route::post('subscribeTag/{userId}', 'Api\TagController@subscribeTag');
Route::get('tags/{userId}', 'Api\TagController@userTags');
Route::get('tags', 'Api\TagController@getAllTags');



// like
Route::post('post_like', 'Api\LikeController@like');
Route::get('post_unlike/{likeId}', 'Api\LikeController@unlike');
Route::get('like_or_not/{likeId}/{postId}', 'Api\LikeController@getLikeStatus');


//comment
Route::post('comment_post/{postId}', 'Api\CommentController@createComment');


// posts
Route::get('postByTag/{tagName}', 'Api\PostController@tagPosts');
Route::get('posts/{userId}', 'Api\PostController@userPosts');
Route::get('posts', 'Api\PostController@allPosts');
Route::post('create_post', 'Api\PostController@createPost');
Route::get('post/{id}', 'Api\PostController@postDetail');
Route::get('followedUserPost/{currentUserId}', 'Api\PostController@getFollowedUserPost');
Route::get('getAuthUserFollowedPosts/{currentUserId}', 'Api\PostController@getAuthUserFollowedPosts');



});


Route::get('/usertest', function () {
    return UserResource::collection(User::paginate());
});




//close middleware group api auth
// Route::get('tags/{userId}', 'Api\TagController@index');
