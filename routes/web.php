<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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

// Call symbolic link storage
Route::get('/97CEE0E580515EEFC92470A8DCD1C071A1464756E28E8B940EC8B86ECDEB12F1/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created';
});

//Admin Routes
// Auth Admin Routes
Route::middleware(['guest:admin'])->prefix('admin')->group(function () {
    Route::get('register', [AdminController::class, 'showAdminRegisterForm'])->name('admin.register');
    Route::post('register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('login', [AdminController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
});

Route::middleware(['auth:admin', 'admin'])->group(function () {
    Route::post('logout-admin', [AdminController::class, 'logout'])->name('admin.logout');
    Route::resource('admin', AdminController::class)->except(['create', 'store', 'show', 'edit']);
    Route::get('/table/user', [AdminController::class, 'dashboard'])->name('admin.table');
    Route::get('/table/user/{id}', [AdminController::class, 'showApplicant'])->name('admin.showApplicant');
    Route::get('/table/user/{id}/edit', [AdminController::class, 'showEditFrom'])->name('admin.showEditForm');
    Route::put('/table/user/{id}/update', [AdminController::class, 'updateDocument'])->name('admin.updateDocument');
    Route::get('/table/export-data', [AdminController::class, 'exportApplicant'])->name('admin.exportApplicant');

    // All Data
    Route::get('/table/all-data', [AdminController::class, 'allData'])->name('admin.allData');
    Route::get('/table/export-specific-data', [AdminController::class, 'exportSpecificAllData'])->name('admin.exportSpecificAllData');
    Route::get('/table/export-all-data', [AdminController::class, 'exportAllData'])->name('admin.exportAllData');

    // Archive
    // Route::get('/table/archive', [AdminController::class, 'archive'])->name('admin.archive');
    Route::post('/table/archive', [AdminController::class, 'archiveYear'])->name('admin.archiveYear');

    // Download ZIP
    Route::get('/table/download-zip/{id}', [AdminController::class, 'makeZip'])->name('admin.downloadZip');

    // Status & Comment
    Route::get('/table/user-status', [AdminController::class, 'status'])->name('admin.status');
    Route::post('/table/user/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::patch('/table/user/comment', [AdminController::class, 'updateComment'])->name('admin.updateComment');
    Route::prefix('admin')->group(function () {
        // Blog
        Route::get('/blog', [AdminController::class, 'blog'])->name('admin.blog');
        Route::get('/blog/{id}/preview', [AdminController::class, 'showBlog'])->name('admin.showBlog');
        Route::get('/blog/create', [AdminController::class, 'showCreateBlogForm'])->name('admin.createBlog');
        Route::post('/blog/store', [AdminController::class, 'storeBlog'])->name('admin.storeBlog');
        Route::get('/blog/{id}/edit', [AdminController::class, 'showEditBlogForm'])->name('admin.editBlog');
        Route::put('/blog/{id}/update', [AdminController::class, 'updateBlog'])->name('admin.updateBlog');
        Route::delete('/blog/{id}/delete', [AdminController::class, 'deleteBlog'])->name('admin.deleteBlog');
        //User
        Route::get('/user', [AdminController::class, 'showAllUser'])->name('admin.user');
        Route::patch('/user/{id}/update-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
        Route::delete('/user/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    });
});


// User Routes
// Auth User Routes
Route::middleware(['guest:web'])->group(function () {
    Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [UserController::class, 'register'])->name('user.register');
    Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserController::class, 'login'])->name('user.login');
});

// Protected Routes
Route::middleware(['auth:web'])->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/home', [UserController::class, 'index'])->name('user.index');
    Route::get('/apply', [UserController::class, 'showApplyForm'])->name('user.apply');
    Route::post('/apply', [UserController::class, 'submitApplication'])->name('user.submitApplication');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'showUpdateProfileForm'])->name('user.updateProfile');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');
});
