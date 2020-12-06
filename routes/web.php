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

Route::post('/user/register', 'Auth\UserController@register')->name('user.register');
Route::put('/user/update', 'Auth\UserController@update')->name('user.update');
Route::delete('/user/delete', 'Auth\UserController@destroy')->name('user.delete');
Route::patch('/user/update-photo', 'Auth\UserController@updatePhoto')->name('user.update-photo');
Route::patch('/user/update-password', 'Auth\UserController@updatePassword')->name('user.update-password');
Route::delete('/user/delete-photo', 'Auth\UserController@deletePhoto')->name('user.delete-photo');

Route::post('/faculty/register', 'FacultyController@register')->name('faculty.register');
Route::put('/faculty/update', 'FacultyController@update')->name('faculty.update');
Route::delete('/faculty/delete', 'FacultyController@destroy')->name('faculty.delete');

Route::post('/program/register', 'ProgramController@register')->name('program.register');
Route::put('/program/update', 'ProgramController@update')->name('program.update');
Route::delete('/program/delete', 'ProgramController@destroy')->name('program.delete');

Route::post('/activity/register', [\App\Http\Controllers\ActivityController::class, 'register'])->name('activity.register');
Route::delete('/activity/delete', [\App\Http\Controllers\ActivityController::class, 'destroy'])->name('activity.delete');
Route::put('/activity/{activity}/update', [\App\Http\Controllers\ActivityController::class, 'update'])->name('activity.update');

Route::post('/requirement/register', [\App\Http\Controllers\RequirementController::class, 'register'])->name('requirement.register');
Route::delete('/requirement/delete', [\App\Http\Controllers\RequirementController::class, 'destroy'])->name('requirement.delete');

Route::get('/lista-estudiantes', [\App\Http\Controllers\HomeController::class, 'studentsList'])->name('students');
Route::get('/lista-docentes', 'HomeController@teachersList')->name('teachers');
Route::get('/lista-directores', 'HomeController@directorsList')->name('directors');
Route::get('/lista-facultades', 'HomeController@facultiesList')->name('faculties');
Route::get('/lista-programas', 'HomeController@programsList')->name('programs');
Route::get('/lista-actividades', [\App\Http\Controllers\HomeController::class, 'activitiesList'])->name('activities');


Route::get('/perfil-docente/{teacher}', 'HomeController@showTeacher')->name('user.show-teacher');
Route::get('/perfil-estudiante/{student}', 'HomeController@showStudent')->name('user.show-student');
Route::get('/perfil-director/{director}', 'HomeController@showDirector')->name('user.show-director');
Route::get('/perfil-facultad/{faculty}', 'HomeController@showFaculty')->name('user.show-faculty');
Route::get('/perfil-programa/{program}', 'HomeController@showProgram')->name('user.show-program');
Route::get('/perfil-actividad/{activity}', [\App\Http\Controllers\HomeController::class, 'showActivity'])->name('user.show-activity');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('user.home');
