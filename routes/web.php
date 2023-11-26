<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SellerController;
use App\Mail\VerificationEmail;
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

Route::get('preview',function(){
    $data = [
        'email'=>'hehehe'
    ];
    return new VerificationEmail($data);
});
Route::controller(FrontendController::class)->group(function () {
    Route::get('/','homepage');
    Route::get('/privacy-policy','privacy');
    Route::get('/terms_and_conditions','terms_and_conditions');
    Route::get('/about','about');
    Route::get('/contact','contact');
    Route::get('/properties','properties');
    Route::get('/property/view/{id}','view_property')->name('view_property');
    Route::get('/property/contact/{id}/seller','contact_seller_property')->name('contact_seller_property');
    Route::post('/contact','send_contact')->name('contact_store');
});
Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/seller','store_seller')->name('auth_seller_signup');
    Route::post('/auth/agent','store_agent')->name('auth_agent_signup');
    Route::post('/auth/buyer','store_buyer')->name('auth_buyer_signup');
    Route::post('/auth/login','login_account')->name('auth_signin');
    Route::get('/auth/logout','user_logout')->name('auth_user_logout');
    Route::get('/admin/login','admin_login')->name('admin_login');
    Route::post('/admin/login','admin_login_post')->name('admin_login_post');
    Route::get('/admin/logout','admin_logout')->name('admin_logout');
    Route::get('/auth/verify/{email}/{type}','verify_email')->name('verify_email');
});

Route::controller(SellerController::class)->group(function () {

    Route::get('/seller/manage_properties','manage_properties')->name('seller_manage_properties');
    Route::get('/seller/property/add','add_property')->name('seller_add_property');
    Route::get('/seller/feedback','seller_feedback')->name('seller_feedback');
    Route::post('/seller/property/add','store_property')->name('seller_store_property');
    Route::get('/seller/property/delete/{id}','delete_property')->name('seller_delete_property');
    Route::get('/seller/property/delete/{id}/photo','delete_property_photo')->name('seller_delete_property_photo');
    Route::get('/seller/property/edit/{id}','edit_property')->name('seller_edit_property');
    Route::post('/seller/property/update/{id}','update_property')->name('seller_update_property');
    Route::get('/seller/account','seller_account')->name('seller_account');
    Route::post('/seller/account','seller_update_account')->name('seller_update_account');
    Route::post('/seller/account/profile','seller_update_account_profile')->name('seller_update_account_profile');
    Route::post('/seller/account/password','seller_update_account_password')->name('seller_update_account_password');
    Route::post('/seller/feedback','seller_add_feedback')->name('seller_add_feedback');
    Route::get('/seller/feedback/{id}/delete','seller_delete_feedback')->name('seller_delete_feedback');
});

Route::controller(BuyerController::class)->group(function () {

    Route::get('/buyer/bookmark/{id}','buyer_add_bookmark')->name('buyer_add_bookmark');
    Route::get('/buyer/bookmarks','buyer_bookmarks')->name('buyer_bookmarks');
    Route::get('/buyer/feedback','buyer_feedback')->name('buyer_feedback');
    Route::get('/buyer/account','buyer_account')->name('buyer_account');
    Route::get('/buyer/appointment','buyer_appointment')->name('buyer_appointment');
    Route::post('/buyer/account','buyer_update_account')->name('buyer_update_account');
    Route::post('/buyer/account/profile','buyer_update_account_profile')->name('buyer_update_account_profile');
    Route::post('/buyer/account/password','buyer_update_account_password')->name('buyer_update_account_password');
    Route::post('/buyer/property/appointment/{property}/{agent}','buyer_add_ppointment')->name('buyer_add_ppointment');
    Route::post('/buyer/feedback','buyer_add_feedback')->name('buyer_add_feedback');
    Route::get('/buyer/feedback/{id}/delete','buyer_delete_feedback')->name('buyer_delete_feedback');
});

Route::controller(AgentController::class)->group(function () {
    Route::get('/agent/account','agent_account')->name('agent_account');
    Route::get('/agent/appointment','agent_appointment')->name('agent_appointment');
    Route::get('/agent/assign_propery','agent_assign_propery')->name('agent_assign_propery');
    Route::get('/agent/feedback','agent_feedback')->name('agent_feedback');
    Route::post('/agent/account','agent_update_account')->name('agent_update_account');
    Route::post('/agent/account/profile','agent_update_account_profile')->name('agent_update_account_profile');
    Route::post('/agent/account/password','agent_update_account_password')->name('agent_update_account_password');
    Route::post('/agent/appointment/approve/{id}','agent_update_appointment_approve')->name('agent_update_appointment_approve');
    Route::post('/agent/appointment/decline/{id}','agent_update_appointment_decline')->name('agent_update_appointment_decline');
    Route::post('/agent/feedback','agent_add_feedback')->name('agent_add_feedback');
    Route::get('/agent/feedback/{id}/delete','agent_delete_feedback')->name('agent_delete_feedback');
});
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/homepage','homepage')->name('admin_homepage');

    Route::get('/admin/buyer_account','buyer_account')->name('admin_buyer_account');

    Route::get('/admin/seller_account','seller_account')->name('admin_seller_account');
    Route::get('/admin/seller/license/download/{id}','download_license')->name('admin_license_download');
    Route::get('/admin/seller/approve/{id}','seller_approve')->name('admin_seller_approve');
    Route::get('/admin/seller/decline/{id}','seller_decline')->name('admin_seller_decline');

    Route::get('/admin/agent_account','agent_account')->name('admin_agent_account');
    Route::get('/admin/agent/license/download/{id}','agent_download_license')->name('admin_agent_license_download');
    Route::get('/admin/agent/approve/{id}','agent_approve')->name('admin_agent_approve');
    Route::get('/admin/agent/decline/{id}','agent_decline')->name('admin_agent_decline');


    Route::get('/admin/properties','properties')->name('admin_properties');
    Route::get('/admin/property/approve/{id}','property_approve')->name('admin_property_approve');
    Route::get('/admin/property/decline/{id}','property_decline')->name('admin_property_decline');
    Route::get('/admin/property/view/{id}','property_view')->name('admin_property_view');
    Route::get('/admin/property/agents','property_agents')->name('admin_property_agents');
    Route::get('/admin/property/assign/{agent}/{property}','property_assign')->name('admin_property_assign');
});
