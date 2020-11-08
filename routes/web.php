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

Route::put('/user/update', 'Auth\UserController@update')->name('user.update');
Route::post('/user/register', 'Auth\UserController@register')->name('user.register');
Route::delete('/user/delete', 'Auth\UserController@destroy')->name('user.delete');
Route::patch('/user/update-photo', 'Auth\UserController@updatePhoto')->name('user.update-photo');
Route::patch('/user/update-password', 'Auth\UserController@updatePassword')->name('user.update-password');
Route::delete('/user/delete-photo', 'Auth\UserController@deletePhoto')->name('user.delete-photo');

Route::get('/lista-estudiantes', 'HomeController@studentsList')->name('students');
Route::get('/lista-docentes', 'HomeController@teachersList')->name('teachers');
Route::get('/lista-directores', 'HomeController@directorsList')->name('directors');
Route::get('/lista-facultades', 'HomeController@facultiesList')->name('faculties');


Route::get('/perfil-docente/{teacher}', 'HomeController@showTeacher')->name('user.show-teacher');
Route::get('/perfil-estudiante/{student}', 'HomeController@showStudent')->name('user.show-student');
Route::get('/perfil-director/{director}', 'HomeController@showDirector')->name('user.show-director');
Route::get('/perfil-facultad/{faculty}', 'HomeController@showDirector')->name('user.show-faculty');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('user.home');
