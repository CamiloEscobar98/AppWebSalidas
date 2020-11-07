<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::put('/update-user', 'Auth\UserController@update')->name('user.update');
Route::patch('/update-user-photo', 'Auth\UserController@updatePhoto')->name('user.update-photo');
Route::patch('/update-user-password', 'Auth\UserController@updatePassword')->name('user.update-password');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
