<?php

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


Auth::routes();

// raggruppo le rotte admin specificando il namespace e il prefix
Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group( function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/posts', 'PostController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    
});

Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');
