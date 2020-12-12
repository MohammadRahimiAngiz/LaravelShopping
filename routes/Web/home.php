<?php

//use App\User;
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
//    auth()->loginUsingId('9');
//dd(auth()->user()->getAuthPassword());
//$product=\App\Product::find(4);
//$product->comments()->create([
//    'comment'=>'this my second comments',
//    'user_id'=>auth()->user()->id,
//]);

return view('layouts.app');
//auth()->user()->comments()->create([
//    'comment'=>'this is my comment',
//    'commentable_id'=>$product->id,
//    'commentable_type'=>'App\Product',
//]);
//return $product->comments()->get();
//    return view('home.layouts.masterHome');
});

Auth::routes(['verify' => true]);
Route::get('/auth/google', 'Auth\GoogleAuthController@redirect')->name('auth.google');
Route::get('/auth/google/callback', 'Auth\GoogleAuthController@callback');
Route::get('/auth/token', 'auth\authTokenController@getToken')->name('2fa.token');
Route::post('/auth/token', 'auth\authTokenController@postToken');
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('profile')->namespace('profile')->group(function () {
    Route::get('/', 'indexController@index')->name('profile');
    Route::get('twoFactor', 'twoFactorAuthController@manageTwoFactor')->name('twoFactor');
    Route::post('twoFactor', 'twoFactorAuthController@postManageTwoFactor');
    Route::get('TwoFactor/phone', 'tokenAuthController@getVerifyPhone')->name('tokenVerifyPhone');
    Route::post('TwoFactor/phone', 'tokenAuthController@postVerifyPhone');
});
Route::get('products','ProductController@index');
Route::get('product/{product:slug_title}','ProductController@single');
Route::post('comments','HomeController@comment')->name('send.comment');
