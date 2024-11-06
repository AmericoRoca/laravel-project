<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Auth;

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes();

// Rutas para configuración de usuario
Route::get('/config', [UserController::class, 'config'])->name('config');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');

// Rutas para imágenes
Route::get('/upload-image', [ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/{id}', [ImageController::class, 'detail'])->name('image.detail');
Route::get('/image/delete/{id}', [ImageController::class, 'delete'])->name('image.delete');

// Rutas para comentarios
Route::post('/comment/save', [CommentController::class, 'save'])->name('comment.save');

// Rutas para likes
Route::get('/like/{image_id}', [LikesController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [LikesController::class, 'dislike'])->name('like.delete');
Route::get('/likes', [LikesController::class, 'index'])->name('likes');
