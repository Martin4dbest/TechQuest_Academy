<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset']);

// Email Verification Routes
Route::get('email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::post('/welcome', 'App\Http\Controllers\SignIn@sign_in')->name('staff.signin');
Route::post('/', 'App\Http\Controllers\SignOut@sign_out')->name('staff.signout');

Route::get('/sign-in', function () {
    return view('sign-in');
});
Route::get('/sign-out', function () {
    return view('sign-out');
});

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@admin')->name('role:admin');
    Route::get('/admin/staffs', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/staffs/{id}', 'App\Http\Controllers\AdminController@trash')->name('delete.staff');

    Route::get('/admin/view-staff/{id}', [AdminController::class, 'viewstaff']);

    Route::get('/admin/add-staff', [AdminController::class, 'addstaff'])->name('addstaff.index');
    Route::post('/admin/add-staff', [AdminController::class, 'store'])->name('addstaff.store');

    //Route::get('/admin/edit-profile', 'App\Http\Controllers\AdminController@edit')->name('admin.edit-profile');
    //Route::get('/admin/edit-profile/{id}', [AdminController::class, 'editstaff']);
    //Route::put('/admin/edit-profile/{id}', [AdminController::class, 'update'])->name('admin.update-profile');
    //Route::put('/admin/edit-profile/{id}', 'App\Http\Controllers\AdminController@update')->name('admin.update-profile');
    //Route::delete('/admin/delete-staff/{id}', [AdminController::class, 'delete'])->name('admin.staff.delete');

    Route::get('/admin/edit-profile/{id}', [AdminController::class, 'editstaff']);
    Route::get('/admin/edit-profile', 'App\Http\Controllers\AdminController@edit')->name('admin.edit-profile');
    Route::put('/admin/edit-profile/{id}', 'App\Http\Controllers\AdminController@update')->name('admin.update-profile');

});

// Dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/dashboard', [DashboardController::class, 'user'])->name('role:user')->name('role:user');
    Route::get('/dashboard/view-profile', [DashboardController::class, 'view_profile']);
    Route::put('/dashboard/edit-profile', [DashboardController::class, 'update'])->name('update-profile');
    Route::get('/dashboard/edit-profile', [DashboardController::class, 'edit_profile']);
});


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/google', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\RegisterController@handleProviderCallback');


