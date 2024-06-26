<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Rtl;

use App\Http\Livewire\Crm;
use App\Http\Livewire\Samples;
use App\Http\Livewire\CustomerFeedback;
use App\Http\Livewire\LocationSolution;
use App\Http\Livewire\LsOrderStatus;

use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;

use Illuminate\Http\Request;

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

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    //CRM
    Route::get('/crm', Crm::class)->name('crm');
    Route::get('/crm-details/{id}',Crm::class)->name('crm_details');

    //Samples
    Route::get('/samples', Samples::class)->name('samples');
    Route::get('/sample-details/{id}',Samples::class)->name('sample_details');

    //Customer Feedback
    Route::get('/customer-feedback', CustomerFeedback::class)->name('customer-feedback');
    Route::get('/customer-feedback-details/{id}',CustomerFeedback::class)->name('customer-feedback-details');

    //LocationSolution
    Route::get('/location-solution', LocationSolution::class)->name('location-solution');
    Route::get('/ls-order-status', LsOrderStatus::class)->name('ls-order-status');


    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');
    
});

Route::get('/clear-all-cache',function(){
        Artisan::call('cache:clear');
        
        dd('cache clear all');
    });