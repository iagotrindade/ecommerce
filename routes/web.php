<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

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

Route::middleware(["auth"])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/order', [OrderController::class, 'order'])->name('order');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('adm.logout');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::post('/image/new', [GalleryController::class, 'new'])->name('image.new');
    Route::post('/image/delete', [GalleryController::class, 'delete'])->name('image.delete');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/new', [UserController::class, 'new'])->name('users.new');
    Route::post('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::post('/permissions/new', [PermissionController::class, 'new'])->name('permissions.new');
    Route::post('/permissions/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
});


Route::get('/adm', [AuthController::class, 'index'])->name('login');

Route::post('/adm/login/action', [AuthController::class, 'loginAction'])->name('adm.login.action');

Route::get('/adm/login/confirm', [AuthController::class, 'confirmLogin'])->name('confirm.adm.login');

Route::post('/adm/login/confirm', [AuthController::class, 'confirmLoginAction'])->name('confirm.adm.login.action');






