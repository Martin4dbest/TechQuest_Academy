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

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@index')->name('role:admin');
    Route::get('/dashboard/dashboard', 'App\Http\Controllers\DashboardController@index')->name('role:user');
    Route::get('/admin/staffs', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/view-profile/{id}', [AdminController::class, 'viewstaff']);
    Route::get('/admin/add-staff', [AdminController::class, 'addstaff'])->name('addstaff.index');
    Route::post('/admin/add-staff', [AdminController::class, 'store'])->name('addstaff.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'editstaff']);
    Route::put('/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete-staff/{id}', [AdminController::class, 'delete'])->name('admin.staff.delete');
});
// Home route for authenticated users
Route::get('/home', [HomeController::class, 'index'])->name('home');
