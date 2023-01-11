<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;


// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Bookin Router
Route::get('services', 'App\Http\Controllers\ServicesController@index');
Route::post('services', 'App\Http\Controllers\ServicesController@store');
Route::get('services/{id}', 'App\Http\Controllers\ServicesController@show');

Route::get('appointment/{id}', 'App\Http\Controllers\ServicesController@showAppointment');
Route::get('appointment', 'App\Http\Controllers\ServicesController@showAppointment');
Route::delete('appointment/{id}', 'App\Http\Controllers\ServicesController@destroy');

Route::get('clients', 'App\Http\Controllers\ClientController@index');
Route::get('clients/{email}', 'App\Http\Controllers\ClientController@show'); // get single client
Route::delete('clients/{id}', 'App\Http\Controllers\ClientController@destroy');

Route::get('stylist/{id}', 'App\Http\Controllers\ClientStylist@show');
Route::get('stylist', 'App\Http\Controllers\ClientStylist@index');

Route::get('service/{id}', 'App\Http\Controllers\ServiceController@show');
Route::get('service', 'App\Http\Controllers\ServiceController@index');

Route::resource('/client', 'App\Http\Controllers\ProductsController')->except([
  'create', 'edit'
]);


//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

  //User
  Route::get('/user', [AuthController::class, 'user']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::PUT('/user/{id}', [AuthController::class, 'update']);


  // Post
  Route::get('/posts', [PostController::class, 'index']); // all posts
  Route::post('/posts', [PostController::class, 'store']); // create post
  Route::get('/posts/{id}', [PostController::class, 'show']); // get single post
  Route::put('/posts/{id}', [PostController::class, 'update']); // update post
  Route::delete('/posts/{id}', [PostController::class, 'destroy']); // delete post

  //clients
  //  Route::get('/clients/{id}', [ClientController::class, 'show']); // get single client
  //  Route::get('/clients', [ClientController::class, 'index']); // all clients posts

  // Comment
  Route::get('/posts/{id}/comments', [CommentController::class, 'index']); // all comments of a post
  Route::post('/posts/{id}/comments', [CommentController::class, 'store']); // create comment on a post
  Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
  Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment

  // Like
  Route::post('/posts/{id}/likes', [LikeController::class, 'likeOrUnlike']); // like or dislike back a post
});
