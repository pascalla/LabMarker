<?php

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

Route::get('/', 'HomeController@index')->name('home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

// User Routes
Route::get('/user/create', 'UserController@create')->name('user.create')->middleware('permission:admin');
Route::get('/users', 'UserController@index')->name('user.index')->middleware('permission:admin');
Route::get('/user/{id}', 'UserController@show')->name('user.show')->middleware('permission:admin');
Route::post('/user/store', 'UserController@store')->name('user.store')->middleware('permission:admin');

// Lab Routes
Route::get('/lab/create', 'LabController@create')->name('lab.create')->middleware('permission:create labs');
Route::get('/labs', 'LabController@index')->name('lab.index');
Route::get('/lab/{id}', 'LabController@show')->name('lab.show')->middleware('checkLabPermission');
Route::post('/lab/store', 'LabController@store')->name('lab.store')->middleware('permission:create labs');

// Marker Misc Route
Route::post('/marker/add', 'MarkerController@assignLabMarker')->name('marker.add')->middleware('modifyLabPermission');

// Task Routes
Route::post('/task/store', 'TaskController@store')->name('task.store')->middleware('modifyLabPermission');
Route::delete('/task/{id}', 'TaskController@destroy')->name('task.destroy')->middleware('modifyLabPermission');

// Task Progress Routes
Route::post('/taskprogress/store', 'TaskProgressController@store')->name('taskprogress.store')->middleware('modifyLabPermission');

// Student Routes
Route::get('/student/create', 'StudentController@create')->name('student.create')->middleware('permission:create lecturer');
Route::get('/students', 'StudentController@index')->name('student.index')->middleware('permission:create lecturer');
Route::get('/student/{id}', 'StudentController@show')->name('student.show');
Route::post('/student/store', 'StudentController@store')->name('student.store')->middleware('permission:create lecturer');

// Enrollment Routes
Route::post('/enrollment/store', 'EnrollmentController@store')->name('enrollment.store')->middleware('modifyLabPermission');
