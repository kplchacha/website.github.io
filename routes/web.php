<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\UserPaymentController;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => view('welcome'))->name('welcome');

Route::group(['middleware' => ['auth']], function(){

    Route::get('dashboard', DashboardController::class)
        ->name('dashboard')
        ->middleware('can:access-dashboard');

    Route::resource('roles', RoleController::class)
        ->only('index');

    Route::resource('messages', MessageController::class)
        ->only('index');

    Route::resource('users.messages', UserMessageController::class)
        ->only('index');
        
    Route::resource('permissions', PermissionController::class)
        ->only('index');

    Route::resource('users', UserController::class)
        ->only('index');

    Route::resource('roles.users', RoleUserController::class)
        ->only('index');

    Route::get("payment-methods", [PaymentMethodController::class, 'index'])
        ->name('payment-methods.index');
        
    Route::resource('properties', PropertyController::class)
        ->only(['index', 'show']);

    Route::get('tenants/{roomUser}', [TenantController::class, 'show'])
        ->name('tenants.show');

    Route::get('user/payments', [UserPaymentController::class, 'index'])
        ->name('user.payments');

    Route::get('user/payments/print', [UserPaymentController::class, 'print'])
        ->name('user.payments.print');
});