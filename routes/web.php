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
})->name('guest.index');;

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth') 
    ->namespace('Admin')
    ->name('admin.') 
    ->prefix('admin') 
    ->group(function () {
        Route::get('/', 'HomeController@index')
            ->name('home');
        Route::get('/categories', 'CategoryController@index')->name('categories.index');
        Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');
        Route::resource('posts', 'PostController');
    });