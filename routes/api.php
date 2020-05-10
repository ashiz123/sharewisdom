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

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

//api group middleware
Route::group(['middleware' => 'auth:api'], function(){
Route::get('user', 'Api\UserController@details');
Route::get('tags/{userId}', 'Api\TagController@userTags');
});

//close middleware group api auth
// Route::get('tags/{userId}', 'Api\TagController@index');
