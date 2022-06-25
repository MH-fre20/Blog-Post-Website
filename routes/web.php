<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\notHomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', function () {
//     return view('home.index');
// });

// Route::get('/contact', function () {
//     return view('home.contact');
// });

/* Route::get('/contact', [HomeController::class, 'contact' ])->name('home.contact'); */
/* 
Route::get('/posts/{id}', function ($id) {
    $posts = [
        1 => [
            'title' => 'Intro to laravel',
            'content' => 'This is a short intro to laravel',
            'is_new' => true
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to php',
            'is_new' => false
        ]
    ];

    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
});

Route::view('/posts/index', 'posts.index'); */
Route::resource('posts', PostController::class);

Route::get('/', [notHomeController::class, 'home'])->name('nothome.index')->middleware('auth');

Route::get('/contact', [notHomeController::class, 'contact'])->name('nothome.contact');

Route::get('/single', AboutController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/secret', [notHomeController::class, 'secret'])
->name('secret')
->middleware('can:hello_mohamad');


Route::resource('/users', UserController::class)->only(['show', 'edit', 'update']);

Route::resource('posts.comments', 'PostCommentController')->only(['store']);


//Route for Tags
Route::get("posts/tag/{tag}", [PostTagController::class, 'index'])
->name('posts.tags.index');