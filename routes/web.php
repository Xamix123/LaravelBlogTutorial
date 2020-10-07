<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/post/add', [PostController::class, 'getFormAdd']) ->name('getFormAdd');
    Route::post('/post/add', [PostController::class, 'createPost'])->name('createPost');

    Route::get('/post/{post}/update', [PostController::class, 'getFormUpdate'])->name('getFormUpdate');
    Route::post('/post/{post}/update', [PostController::class, 'updatePost'])->name('updatePost');

    Route::get('/post/{post}/delete', [PostController::class, 'deletePost'])->name('deletePost');

    Route::post('/comment/{post}', [CommentController::class, 'createComment'])->name('addComment');
});


Route::get('/post/all', [PostController::class, 'getListPosts'])->name('getPostList');
Route::get('/post/{post}', [PostController::class, 'getPost'])->name('getPost');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
