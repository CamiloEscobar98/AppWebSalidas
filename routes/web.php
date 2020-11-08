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
Route::post('/register-user', 'Auth\UserController@register')->name('user.register');
Route::patch('/update-user-photo', 'Auth\UserController@updatePhoto')->name('user.update-photo');
Route::patch('/update-user-password', 'Auth\UserController@updatePassword')->name('user.update-password');
Route::delete('/delete-user-photo', 'Auth\UserController@deletePhoto')->name('user.delete-photo');

Route::get('/lista-estudiantes', 'Auth\UserController@studentsList')->name('user.students');
Route::get('/perfil-estudiante/{student}', 'Auth\UserController@showStudent')->name('user.show-student');
Route::delete('/delete-student', 'Auth\UserController@destroyStudent')->name('user.delete-student');

Route::get('/lista-docentes', 'Auth\UserController@teachersList')->name('user.teachers');
Route::get('/perfil-docente/{teacher}', 'Auth\UserController@showTeacher')->name('user.show-teacher');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
