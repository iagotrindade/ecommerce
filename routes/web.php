<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AsaasController;

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
    Route::get('/pedidos', [OrderController::class, 'index'])->name('orders');
    Route::get('/pedido/{id}', [OrderController::class, 'order'])->name('order');
    Route::get('/refund/{id}', [OrderController::class, 'refund'])->name('refund');


    Route::get('/cardapio/{id?}', [CarteController::class, 'index'])->name('carte');

    Route::post('/cardapio/product/novo', [ProductController::class, 'new'])->name('product.new');
    Route::post('/cardapio/editar/produto', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/cardapio/deletar/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::post('/categoria/novo', [CategoryController::class, 'new'])->name('category.new');
    Route::post('/categoria/editar', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categoria/organizar', [CategoryController::class, 'organize'])->name('category.organize');

    Route::get('/qrcode', [QrcodeController::class, 'index'])->name('qrcode');
    Route::get('/qrcode/baixar/{id}', [QrcodeController::class, 'download'])->name('qrcode.download');
    Route::post('/qrcode/novo', [QrcodeController::class, 'new'])->name('qrcode.new');
    Route::post('/qrcode/editar', [QrcodeController::class, 'edit'])->name('qrcode.edit');
    Route::get('/qrcode/deletar/{id}', [QrcodeController::class, 'delete'])->name('qrcode.delete');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/sair/{id}', [AuthController::class, 'logout'])->name('logout');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::post('/image/new', [ImageController::class, 'new'])->name('image.new');
    Route::post('/image/delete', [ImageController::class, 'delete'])->name('image.delete');

    Route::get('/usuarios/{id?}', [UserController::class, 'index'])->name('users');
    Route::post('/usuarios/novo', [UserController::class, 'new'])->name('users.new');
    Route::post('/usuarios/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/usuarios/deletar/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/permissoes', [PermissionController::class, 'index'])->name('permissions');
    Route::post('/permissoes/novo', [PermissionController::class, 'new'])->name('permissions.new');
    Route::post('/permissoes/editar', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissoes/deletar', [PermissionController::class, 'delete'])->name('permissions.delete');
});


Route::middleware(["guest"])->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/adm/login/action', [AuthController::class, 'loginAction'])->name('login.action');

    Route::get('/adm/login/confirm', [AuthController::class, 'confirmLogin'])->name('confirm.login');
    Route::post('/adm/login/confirm', [AuthController::class, 'confirmLoginAction'])->name('confirm.login.action');
    Route::get('/adm/login/resend/code/{id}', [AuthController::class, 'resendConfirmationCode'])->name('resend.verification.code');

    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('/forgot_password_action', [AuthController::class, 'forgotPasswordAction'])->name('forgot.password.action');

    Route::get('/change_password', [AuthController::class, 'changePassword'])->name('password.reset');
    Route::post('/change_password_action', [AuthController::class, 'changePasswordAction'])->name('password.reset.action');

    Route::get('/signup', [UserController::class, 'signup'])->name('signup');
    Route::post('/signup/action', [UserController::class, 'signupAction'])->name('signup.action');
});


Route::group(['middleware' => ['web']], function () {
    Route::get('/teste', [HomeController::class, 'teste'])->name('teste');
    Route::get('/carrinho', [CartController::class, 'index'])->name('cart');
    Route::get('/{table?}/{productId?}', [HomeController::class, 'index'])->name('home');
    Route::post('/asaas/webhooks/pix', [AsaasController::class, 'webhookPix'])->name('webhook.pix');
});




