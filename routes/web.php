<?php

use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MercadoPagoWebhookController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/termo', [HomeController::class, 'terms'])->name('terms');
Route::get('/cadastro-pendente', [HomeController::class, 'pending'])->name('pending');

Route::get('/contato', [ContactController::class, 'create'])->name('contact');
Route::post('/contato', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->middleware('throttle:8,1')->name('login.store');

    Route::get('/cadastro', [AuthController::class, 'createRegister'])->name('register');
    Route::post('/cadastro', [AuthController::class, 'storeRegister'])->middleware('throttle:6,1')->name('register.store');

    Route::get('/esqueci-senha', [AuthController::class, 'createForgotPassword'])->name('password.request');
    Route::post('/esqueci-senha', [AuthController::class, 'storeForgotPassword'])->name('password.email');
    Route::get('/redefinir-senha/{token}', [AuthController::class, 'createResetPassword'])->name('password.reset');
    Route::post('/redefinir-senha', [AuthController::class, 'storeResetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/perguntar', [QuestionController::class, 'show'])->name('question');
    Route::get('/alterar-senha', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/alterar-senha', [PasswordController::class, 'update'])->name('password.change');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/usuarios', [AdminUserController::class, 'index'])->name('users');
    Route::post('/usuarios/{user}/liberar', [AdminUserController::class, 'activate'])->name('users.activate');
    Route::get('/mensagens', [AdminMessageController::class, 'index'])->name('messages');
    Route::delete('/mensagens/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
});

Route::post('/notificacao', MercadoPagoWebhookController::class)->name('mercadopago.webhook');

Route::permanentRedirect('/home', '/');
Route::permanentRedirect('/user_register', '/cadastro');
Route::permanentRedirect('/question', '/perguntar');
Route::permanentRedirect('/contact', '/contato');
Route::permanentRedirect('/responsability', '/termo');
Route::permanentRedirect('/password_forgot', '/esqueci-senha');
Route::permanentRedirect('/registration_pending', '/cadastro-pendente');
Route::permanentRedirect('/users', '/admin/usuarios');
Route::permanentRedirect('/messages', '/admin/mensagens');
