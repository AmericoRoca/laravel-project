<?php

use Illuminate\Support\Facades\Route;

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
use App\Models\Image;
use App\Models\Comment;

Route::get('/', function () {

    $images = Image::all();
    //$coments = Comment::all();

    foreach($images as $image){

        
        echo '<strong>Picture</strong>';
        echo "<br>";
       echo $image->image_path."<br>";
       echo $image->description."<br>";
        echo "<br>";
        
        if(count($image->comments)>=1){
            echo '<strong>Comments</strong>';
            foreach($image->comments as $comment){
                echo $comment->user->name.''.$comment->user->surname.": ";
                echo $comment->content."<br>";
            }
        }
        echo '<strong>Likes:</strong>'.count($image->likes);
        
       
    }




    return view('welcome');
});

Auth::routes();
//HomeController
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//UserController
Route::get('/config', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');
//ImageController
Route::get('/upload-image', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
//CommentController
Route::post('/comment/save', [App\Http\Controllers\CommentController::class, 'save'])->name('comment.save');