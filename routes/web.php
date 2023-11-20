<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SellerController;
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
    return view('homepage');
});
Route::controller(FrontendController::class)->group(function () {
    Route::get('/properties','properties');
    Route::get('/property/view/{id}','view_property')->name('view_property');
});
Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/seller','store_seller')->name('auth_seller_signup');
    Route::post('/auth/buyer','store_buyer')->name('auth_buyer_signup');
    Route::post('/auth/login','login_account')->name('auth_signin');
    Route::get('/auth/logout','user_logout')->name('auth_user_logout');
});

Route::controller(SellerController::class)->group(function () {

    Route::get('/seller/manage_properties','manage_properties')->name('seller_manage_properties');
    Route::get('/seller/property/add','add_property')->name('seller_add_property');
    Route::post('/seller/property/add','store_property')->name('seller_store_property');
    Route::get('/seller/property/delete/{id}','delete_property')->name('seller_delete_property');
    Route::get('/seller/property/delete/{id}/photo','delete_property_photo')->name('seller_delete_property_photo');
    Route::get('/seller/property/edit/{id}','edit_property')->name('seller_edit_property');
    Route::post('/seller/property/update/{id}','update_property')->name('seller_update_property');
    Route::get('/seller/account','seller_account')->name('seller_account');
    Route::post('/seller/account','seller_update_account')->name('seller_update_account');
    Route::post('/seller/account/profile','seller_update_account_profile')->name('seller_update_account_profile');
});

