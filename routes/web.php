<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;


Route::controller(MyController::class)->group(function () {
    Route::get('/', 'goHome')->name("home");

    Route::get('/about', 'goAbout')->name("about");

    Route::get('/posts', 'goPosts')->name('posts');
    Route::get('/create', 'goCreate')->name('create')->middleware(AuthMiddleware::class);
});

Route::controller(PostsController::class)->group(function () {
    Route::post('/new-post', 'newPost')->name('newPost');
    Route::get('/view-post/{id}', 'viewPost')->name('viewPost');
    Route::get('/edit-post/{id}', 'editPost')->name('editPost');
    Route::post('/update-post/{id}', 'updatePost')->name('updatePost');
    Route::post('/remove-post/{id}', 'removePost')->name('removePost');
});


Route::controller(SessionController::class)->group(function () {
    Route::get('/theme', 'theme');
    Route::get('/set-theme/{value}', 'setTheme');
    Route::get('/remove-theme', 'removeTheme');
    Route::get('/check-theme', 'checkTheme');
});



Route::controller(AuthController::class)->group(function () {
    Route::get('/login', "login")->name('login');
    Route::post('/login','loginSave')->name('loginSave');
    Route::get('/register','register')->name('register');
    Route::post('/register','registerSave')->name('registerSave');
    Route::get('/logout', "logout")->name('logout');
    Route::get('/userlist','userlist');
});
