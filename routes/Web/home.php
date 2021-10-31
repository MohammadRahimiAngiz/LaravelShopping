<?php

use App\User;
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

Route::get('/', 'IndexController@index');

Auth::routes(['verify' => true]);
Route::get('/auth/google', 'Auth\GoogleAuthController@redirect')->name('auth.google');
Route::get('/auth/google/callback', 'Auth\GoogleAuthController@callback');
Route::get('/auth/token', 'auth\authTokenController@getToken')->name('2fa.token');
Route::post('/auth/token', 'auth\authTokenController@postToken');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('products', 'ProductController@index');
Route::get('product/{product:slug_title}', 'ProductController@single');
Route::post('cart/add/{product:slug_title}', 'CartController@addToCart')->name('cart.add');
Route::get('cart', 'CartController@cart');
Route::patch('/cart/quantity/change', 'CartController@quantityChange');
Route::delete('cart/delete/{cart}', 'CartController@deleteFromCart')->name('cart.destroy');
Route::middleware('auth')->group(function () {
    Route::prefix('profile')->namespace('profile')->group(function () {
        Route::get('/', 'indexController@index')->name('profile');
        Route::get('twoFactor', 'twoFactorAuthController@manageTwoFactor')->name('twoFactor');
        Route::post('twoFactor', 'twoFactorAuthController@postManageTwoFactor');
        Route::get('TwoFactor/phone', 'tokenAuthController@getVerifyPhone')->name('tokenVerifyPhone');
        Route::post('TwoFactor/phone', 'tokenAuthController@postVerifyPhone');
        Route::get('orders','orderController@index')->name('profile.orders');
        Route::get('orders/{order}','orderController@showDetails')->name('profile.order.Details');
        Route::get('orders/{order}/payment','orderController@payment')->name('profile.orders.payment');
        Route::post('/','indexController@editUser')->name('profile.edit.user');
        Route::post('uploadImage','indexController@UploadImageUser');
    });
    Route::post('comments', 'HomeController@comment')->name('send.comment');
    Route::post('payment', 'PaymentController@payment')->name('cart.payment');
    Route::get('payment/callback', 'PaymentController@callback')->name('payment.callback');
});
