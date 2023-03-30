<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Posts
Route::resource('/posts', PostController::class);
Route::get('/posts/search/{description}', [PostController::class, 'search']);
Route::post('/posts/like', [PostController::class, 'like']);

// Offers
Route::resource('/offers', OfferController::class);
Route::get('/offers/search/{description}', [OfferController::class, 'search']);
Route::post('/offers/like', [OfferController::class, 'like']);

// Users
// Route::post('/register', [UserController::class, 'register']);
// Route::post('/login', [UserController::class, 'login']);
// Route::post('/messages/send', [UserController::class, 'send']);
// Route::post('/users/follow', [UserController::class, 'follow']);
// Route::post('/users/apply', [UserController::class, 'apply']);
Route::get('/users/messages/{user_id}', [UserController::class, 'messages']);
// Route::get('/users/follows/{user_id}', [UserController::class, 'follows']);
// Route::post('/logout', [UserController::class, 'logout']);
