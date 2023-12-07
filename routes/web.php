<?php

use App\Mail\VerificationEmail;
use Phpml\Regression\LeastSquares;
use Phpml\Math\Matrix;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\FrontendController;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;
use League\Csv\Reader;

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

Route::get('preview', function () {
    $csv = Reader::createFromPath(public_path('antipolo.csv'));
    $data = $csv->setHeaderOffset(0)->getRecords();
    $samples = [];
    $targets = [];
    foreach ($data as $row) {
        $samples[] = [(float) $row['Bedroom'], (int) $row['Lot Area (sqm)']];
        $targets[] = (float) $row['Price (PHP)'];
    }


    // $samples = [[1400, 3], [1600, 3], [1700, 4], [1875, 3], [1100, 2]];
    // $targets = [ 1.9,  2.1, 2.3, 2.5,  1.5];
    $regression = new LeastSquares();
    $regression->train($samples, $targets);
    dd(
        $prediction = $regression->predict([2, 157])
    );
    // Predict house prices for the next 10 years
    $future_predictions = [];
    $current_year = date('Y');
    for ($i = 1; $i <= 10; $i++) {
        $prediction = $regression->predict([[1500, 3], [1800, 2], [1500, 3]]);
        $future_predictions[] = [
            'year' => $current_year + $i,
            'prediction' => isset($prediction[$i - 1]) ? $prediction[$i - 1] : $prediction,
        ];
    }

    // Output the predictions
    dd($future_predictions);
});
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'homepage');
    Route::get('/privacy-policy', 'privacy');
    Route::get('/terms_and_conditions', 'terms_and_conditions');
    Route::get('/about', 'about');
    Route::get('/contact', 'contact');
    Route::get('/properties', 'properties');
    Route::get('/property/view/{id}', 'view_property')->name('view_property');
    Route::get('/property/predict/{id}/{number}', 'predict_property')->name('predict_property');
    Route::get('/property/contact/{id}/seller', 'contact_seller_property')->name('contact_seller_property');
    Route::post('/contact', 'send_contact')->name('contact_store');
});
Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/seller', 'store_seller')->name('auth_seller_signup');
    Route::post('/auth/agent', 'store_agent')->name('auth_agent_signup');
    Route::post('/auth/buyer', 'store_buyer')->name('auth_buyer_signup');
    Route::post('/auth/login', 'login_account')->name('auth_signin');
    Route::get('/auth/logout', 'user_logout')->name('auth_user_logout');
    Route::get('/admin/login', 'admin_login')->name('admin_login');
    Route::post('/admin/login', 'admin_login_post')->name('admin_login_post');
    Route::get('/admin/logout', 'admin_logout')->name('admin_logout');
    Route::get('/auth/verify/{email}/{type}', 'verify_email')->name('verify_email');
    Route::get('/auth/forgot_password', 'forgot_password')->name('forgot_password');
    Route::post('/auth/forgot_password', 'send_forgot_password')->name('send_forgot_password');
    Route::get('/auth/change_password/{email}/{type}', 'change_password')->name('change_password');
    Route::post('/auth/change_password/{email}/{type}', 'update_change_password')->name('update_change_password');
});

Route::middleware(['seller.only'])->controller(SellerController::class)->group(function () {

    Route::get('/seller/manage_properties', 'manage_properties')->name('seller_manage_properties');
    Route::get('/seller/property/add', 'add_property')->name('seller_add_property');
    Route::get('/seller/feedback', 'seller_feedback')->name('seller_feedback');
    Route::post('/seller/property/add', 'store_property')->name('seller_store_property');
    Route::get('/seller/property/delete/{id}', 'delete_property')->name('seller_delete_property');
    Route::get('/seller/property/delete/{id}/photo', 'delete_property_photo')->name('seller_delete_property_photo');
    Route::get('/seller/property/edit/{id}', 'edit_property')->name('seller_edit_property');
    Route::post('/seller/property/update/{id}', 'update_property')->name('seller_update_property');
    Route::get('/seller/account', 'seller_account')->name('seller_account');
    Route::post('/seller/account', 'seller_update_account')->name('seller_update_account');
    Route::post('/seller/account/profile', 'seller_update_account_profile')->name('seller_update_account_profile');
    Route::post('/seller/account/password', 'seller_update_account_password')->name('seller_update_account_password');
    Route::post('/seller/feedback', 'seller_add_feedback')->name('seller_add_feedback');
    Route::get('/seller/feedback/{id}/delete', 'seller_delete_feedback')->name('seller_delete_feedback');
    Route::post('/seller/property/sold/{id}','seller_sold_property')->name('seller_sold_property');
});

Route::middleware(['buyer.only'])->controller(BuyerController::class)->group(function () {

    Route::get('/buyer/bookmark/{id}', 'buyer_add_bookmark')->name('buyer_add_bookmark');
    Route::get('/buyer/bookmarks', 'buyer_bookmarks')->name('buyer_bookmarks');
    Route::get('/buyer/feedback', 'buyer_feedback')->name('buyer_feedback');
    Route::get('/buyer/account', 'buyer_account')->name('buyer_account');
    Route::get('/buyer/appointment', 'buyer_appointment')->name('buyer_appointment');
    Route::post('/buyer/account', 'buyer_update_account')->name('buyer_update_account');
    Route::post('/buyer/account/profile', 'buyer_update_account_profile')->name('buyer_update_account_profile');
    Route::post('/buyer/account/password', 'buyer_update_account_password')->name('buyer_update_account_password');
    Route::post('/buyer/property/appointment/{property}/{agent}', 'buyer_add_ppointment')->name('buyer_add_ppointment');
    Route::post('/buyer/feedback', 'buyer_add_feedback')->name('buyer_add_feedback');
    Route::get('/buyer/feedback/{id}/delete', 'buyer_delete_feedback')->name('buyer_delete_feedback');
    Route::get('/buyer/rate/{value}/{agent}/{property}', 'buyer_agent_rate')->name('buyer_agent_rate');
    Route::get('/buyer/appointment/report/{id}', 'buyer_appointment_report')->name('buyer_appointment_report');
});

Route::middleware(['agent.only'])->controller(AgentController::class)->group(function () {
    Route::get('/agent/account', 'agent_account')->name('agent_account');
    Route::get('/agent/appointment', 'agent_appointment')->name('agent_appointment');
    Route::get('/agent/assign_propery', 'agent_assign_propery')->name('agent_assign_propery');
    Route::get('/agent/feedback', 'agent_feedback')->name('agent_feedback');
    Route::post('/agent/account', 'agent_update_account')->name('agent_update_account');
    Route::post('/agent/account/profile', 'agent_update_account_profile')->name('agent_update_account_profile');
    Route::post('/agent/account/password', 'agent_update_account_password')->name('agent_update_account_password');
    Route::post('/agent/appointment/approve/{id}', 'agent_update_appointment_approve')->name('agent_update_appointment_approve');
    Route::post('/agent/appointment/decline/{id}', 'agent_update_appointment_decline')->name('agent_update_appointment_decline');
    Route::post('/agent/feedback', 'agent_add_feedback')->name('agent_add_feedback');
    Route::get('/agent/feedback/{id}/delete', 'agent_delete_feedback')->name('agent_delete_feedback');
    Route::get('/agent/buyer_info/{id}','get_buyer_info')->name('get_buyer_info');
    Route::get('/agent/appointment/report/{id}', 'agent_appointment_report')->name('agent_appointment_report');
    Route::get('/agent/appointment/report/check/{id}', 'agent_appointment_report_check')->name('agent_appointment_report_check');
});
Route::middleware(['admin.only'])->controller(AdminController::class)->group(function () {
    Route::get('/admin/homepage', 'homepage')->name('admin_homepage');

    Route::get('/admin/buyer_account', 'buyer_account')->name('admin_buyer_account');

    Route::get('/admin/seller_account', 'seller_account')->name('admin_seller_account');
    Route::get('/admin/seller/license/download/{id}', 'download_license')->name('admin_license_download');
    Route::get('/admin/seller/approve/{id}', 'seller_approve')->name('admin_seller_approve');
    Route::get('/admin/seller/decline/{id}', 'seller_decline')->name('admin_seller_decline');

    Route::get('/admin/agent_account', 'agent_account')->name('admin_agent_account');
    Route::get('/admin/agent/license/download/{id}', 'agent_download_license')->name('admin_agent_license_download');
    Route::get('/admin/agent/approve/{id}', 'agent_approve')->name('admin_agent_approve');
    Route::get('/admin/agent/decline/{id}', 'agent_decline')->name('admin_agent_decline');


    Route::get('/admin/properties', 'properties')->name('admin_properties');
    Route::get('/admin/property/approve/{id}', 'property_approve')->name('admin_property_approve');
    Route::get('/admin/property/decline/{id}', 'property_decline')->name('admin_property_decline');
    Route::get('/admin/property/delete/{id}', 'property_delete')->name('admin_property_delete');
    Route::get('/admin/property/view/{id}', 'property_view')->name('admin_property_view');
    Route::get('/admin/property/agents', 'property_agents')->name('admin_property_agents');
    Route::get('/admin/property/assign/{agent}/{property}', 'property_assign')->name('admin_property_assign');

    Route::get('/admin/feedback','admin_feedback')->name('admin_feedback');
    Route::get('/admin/feedback/{id}/delete','admin_feedback_delete')->name('admin_feedback_delete');
});
