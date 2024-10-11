<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');



Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::post('logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

  Route::get('users', [UserController::class, 'index']);
  Route::get('users/{id}', [UserController::class, 'show']);
  Route::post('users', [UserController::class, 'store']);
  Route::put('users/{id}', [UserController::class, 'update']);
  Route::delete('users/{id}', [UserController::class, 'destroy']);

  Route::get('roles', [RoleController::class, 'index']);
  Route::get('roles/{id}', [RoleController::class, 'show']);
  Route::post('roles', [RoleController::class, 'store']);
  Route::post('roles/{id}', [RoleController::class, 'update']);

  Route::get('category', [CategoryController::class, 'index']);
  Route::get('category/{slug}', [CategoryController::class, 'show']);
  Route::post('category', [CategoryController::class, 'store']);
  Route::put('category/{id}', [CategoryController::class, 'update']);
  Route::delete('category/{id}', [CategoryController::class, 'destroy']);

  Route::get('blogs', [BlogController::class, 'index']);
  Route::get('blogs/{slug}', [BlogController::class, 'show']);
  Route::post('blogs', [BlogController::class, 'store']);
  Route::put('blogs/{id}', [BlogController::class, 'update']);
  Route::delete('blogs/{id}', [BlogController::class, 'destroy']);
});
