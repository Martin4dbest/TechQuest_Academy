<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\Auth;

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
    return view('welcome');
});

// Authentication routes



// Admin routes
Route::middleware(['auth'])->group(function () {
    // Route::get('/login', [AdminController::class, 'login'])->name('login');
    //Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('authenticate');
    // Route::get('/dashboard/dashboard', [DashboardController::class, 'index']);
    Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@index');
    Route::get('/dashboard/dashboard', 'App\Http\Controllers\DashboardController@index');
    Route::get('/admin/staffs', 'App\Http\Controllers\AdminController@index');
    Route::get('/admin/view-profile/{id}', 'App\Http\Controllers\AdminController@index');

    Route::get('/admin/edit/{id}', 'App\Http\Controllers\AdminController@index');




    
    



    Route::get('/admin/add-staff', [AdminController::class, 'addstaff'])->name('addstaff.index');
    Route::post('/admin/add-staff', [AdminController::class, 'store'])->name('addstaff.store');


});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');