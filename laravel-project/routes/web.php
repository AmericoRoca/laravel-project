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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/config', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

