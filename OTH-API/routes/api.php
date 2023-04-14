<?php

use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [LogoutController::class, 'logout']);
Route::post('messages/{id}', [UserController::class, 'messages']);
Route::post('send', [UserController::class, 'send']);

Route::resource('posts', PostController::class);
Route::resource('offers', OfferController::class);

Route::post('posts/like', [PostController::class, 'like']);
Route::post('offers/like', [OfferController::class, 'like']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('follow', [UserController::class, 'follow']);
Route::post('skills/new', [UserController::class, 'newSkill']);
Route::post('apply', [UserController::class, 'apply']);
Route::get('getSignature', [CloudinaryController::class, 'getsignature']);
Route::get('company/{id}/applications', [UserController::class, 'companyApplications']);
Route::get('user/{id}/applications', [UserController::class, 'userApplications']);
