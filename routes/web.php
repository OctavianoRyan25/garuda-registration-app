<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Admin Routes
Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::post('/store', [UserController::class, 'store'])->name('user.store');

Route::resource('admin', AdminController::class);
Route::get('/table/user', [AdminController::class, 'dashboard'])->name('admin.table');


// User Routes

// Auth User Routes
Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register'])->name('user.register');
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('user.login');
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/home', [UserController::class, 'index'])->name('user.index');
    Route::get('/apply', [UserController::class, 'showApplyForm'])->name('user.apply');
    Route::post('/apply', [UserController::class, 'submitApplication'])->name('user.submitApplication');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'showUpdateProfileForm'])->name('user.updateProfile');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');
});