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
Route::resource('users','User\UserController');
Route::get('users/{user}/permissions','User\permissionController@create')->name('user.permissions');
Route::post('users/{user}/permissions','User\permissionController@store')->name('user.permissions.store');
Route::resource('permissions','permissionController');
Route::resource('roles','RoleController');
Route::resource('products','ProductController')->except('show');
Route::get('dashboard','dashboardController@index')->name('dashboard');
Route::get('comments/unapproved','CommentController@unapproved')->name('comments.unapproved');
Route::resource('comments','CommentController')->only(['index','update','destroy','edit']);
Route::resource('categories','CategoryController')->except('show');

