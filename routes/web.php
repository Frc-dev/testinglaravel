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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/info', function () {
    return phpinfo();
});

Route::get('/post/{id}', 'PostsController@index');

Route::get('/posts', 'PostsController@showAllPosts');

Route::post('/store-post', 'PostsController@storePost');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create-post', 'PostsController@createPost')->middleware('auth');

Auth::routes();
