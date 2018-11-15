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

Route::get('/home', 'HomeController@index')->name('home');

// User Routes
Route::get('/user/create', 'UserController@create')->name('user.create')->middleware('permission:admin');
Route::get('/user/bulkcreate', 'UserController@create')->name('user.bulkcreate')->middleware('permission:admin');
Route::get('/users', 'UserController@index')->name('user.index')->middleware('permission:admin');
Route::get('/user/{id}', 'UserController@show')->name('user.show')->middleware('permission:admin');
Route::post('/user', 'UserController@store')->name('user.store')->middleware('permission:admin');

// Student Routes
Route::get('/lab/{lab_id}/user/{user_id}', 'StudentController@show')->name('student.show')->middleware('checkLabPermission');
Route::get('/student/create', 'StudentController@create')->name('student.create')->middleware('permission:admin');
Route::post('/student', 'StudentController@store')->name('student.store')->middleware('permission:admin');

// Lab Routes
Route::get('/lab/create', 'LabController@create')->name('lab.create')->middleware('permission:create labs');
Route::get('/labs', 'LabController@index')->name('lab.index');
Route::get('/lab/{lab_id}', 'LabController@show')->name('lab.show')->middleware('checkLabPermission');
Route::get('/lab/{lab_id}/modify', 'LabController@modify')->name('lab.modify')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/edit', 'LabController@edit')->name('lab.edit')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/update', 'LabController@update')->name('lab.update')->middleware('modifyLabPermission');
Route::post('/lab', 'LabController@store')->name('lab.store')->middleware('permission:create labs');

// Group Routes
Route::get('/lab/{lab_id}/groups', 'GroupController@index')->name('group.index')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/group/{group_id}/edit', 'GroupController@edit')->name('group.edit')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/group/create', 'GroupController@create')->name('group.create')->middleware('modifyLabPermission');
Route::post('/lab/{lab_id}/group', 'GroupController@store')->name('group.store')->middleware('modifyLabPermission');
Route::post('/lab/{lab_id}/group/{group_id}/update', 'GroupController@update')->name('group.update')->middleware('modifyLabPermission');
Route::delete('/lab/{lab_id}/group/{group_id}', 'GroupController@destroy')->name('group.destroy')->middleware('modifyLabPermission');

// Group Member Routes
Route::get('/lab/{lab_id}/group/{group_id}/member/create', 'GroupMemberController@create')->name('groupmember.create')->middleware('modifyLabPermission');
Route::post('/lab/{lab_id}/group/{group_id}/member', 'GroupMemberController@store')->name('groupmember.store')->middleware('modifyLabPermission');
Route::delete('/lab/{lab_id}/group/{group_id}/member/{student_id}', 'GroupMemberController@destroy')->name('groupmember.destroy')->middleware('modifyLabPermission');

// Marker Routes
Route::get('/lab/{lab_id}/marker', 'MarkerController@index')->name('marker.index')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/marker/create', 'MarkerController@create')->name('marker.create')->middleware('modifyLabPermission');
Route::post('/lab/{lab_id}/marker', 'MarkerController@store')->name('marker.store')->middleware('modifyLabPermission');

// Task Routes
Route::get('/lab/{lab_id}/tasks', 'TaskController@index')->name('task.index')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/tasks/create', 'TaskController@create')->name('task.create')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/task/{task_id}/edit', 'TaskController@edit')->name('task.edit')->middleware('modifyLabPermission');
Route::post('/lab/{lab_id}/task', 'TaskController@store')->name('task.store')->middleware('modifyLabPermission');
Route::post('/lab/{lab_id}/task/{task_id}/update', 'TaskController@update')->name('task.update')->middleware('modifyLabPermission');
Route::delete('/lab/{lab_id}/task/{task_id}', 'TaskController@destroy')->name('task.destroy')->middleware('modifyLabPermission');


// Task Progress Routes
Route::get('/lab/{lab_id}/progress', 'TaskProgressController@index')->name('taskprogress.index')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/download', 'TaskProgressController@download')->name('taskprogress.download')->middleware('modifyLabPermission');
Route::post('/taskprogress', 'TaskProgressController@store')->name('taskprogress.store')->middleware('checkLabPermission');


// Enrollment Routes
Route::get('/lab/{lab_id}/enroll', 'EnrollmentController@index')->name('enrollment.index')->middleware('modifyLabPermission');
Route::get('/lab/{lab_id}/enroll/create', 'EnrollmentController@create')->name('enrollments.create')->middleware('modifyLabPermission');
Route::post('/lab/{lab_id}/enroll', 'EnrollmentController@store')->name('enrollment.store')->middleware('modifyLabPermission');
Route::delete('/enrollments', 'EnrollmentController@destroy')->name('enrollment.destroy')->middleware('modifyLabPermission');
