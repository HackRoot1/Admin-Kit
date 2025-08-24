<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Route::controller(LocationController::class)->group(function () {
    Route::get('/countries', 'countries');
    Route::get('/states/{country_id}', 'states');
    Route::get('/cities/{state_id}', 'cities');
});


// Auth Routes
Route::controller(AuthController::class)->group(function () {
    // Basic Authentication
    Route::view('login', 'auth.sign-in')->name('auth.sign-in');
    Route::view('register', 'auth.sign-up')->name('auth.sign-up');
    Route::post('register', 'register')->name('register');
    Route::post('authenticate', 'authenticate')->name('authenticate')->middleware('throttle:10,1');
    Route::post('logout', 'logout')->name('logout');
    
    // Forgot Password
    Route::get('forgot-password', 'showLinkRequestForm')->name('password.request');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('password.email');
    
    // Reset Password    
    Route::view('reset-password', 'auth.reset-password')->name('auth.reset-password');
    Route::get('reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('reset-password', 'reset')->name('password.update');

    // Socialite Login
    Route::get('auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
    Route::get('auth/{provider}/callback', 'socialAuthentication')->name('auth.social-callback');
});

// Dashboard & User Related Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');
    Route::view('profile-settings', 'settings.profile')->name('settings.profile');
    Route::view('settings', 'settings.settings')->name('settings.settings');


    // Staff Related Routes 
    Route::controller(UserController::class)->group(function () {
        Route::get('staffs-index', 'index')->name('staffs.index');
        Route::view('staffs-create', 'staffs.create')->name('staff.create');
        Route::post('staffs-store', 'store')->name('staff.store');
        Route::get('staffs-edit/{id}', 'edit')->name('staff.edit');
        Route::put('staffs-update/{id}', 'update')->name('staff.update');
        Route::delete('staffs-delete/{id}', 'destroy')->name('staff.destroy');
        Route::get('staffs-show/{id}', 'show')->name('staff.show');
    });

    // 
    Route::put('/roles/{role}/permissions', [RolesController::class, 'updatePermissions'])
        ->name('roles.updatePermissions');
    Route::post('/users/{id}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');


    // Roles Related Routes
    Route::controller(RolesController::class)->group(function () {
        Route::get('roles-index', 'index')->name('roles.index');
        Route::view('roles-create', 'roles.create')->name('role.create');
        Route::post('roles-store', 'store')->name('role.store');
        Route::get('roles-edit/{id}', 'edit')->name('role.edit');
        Route::put('roles-update/{id}', 'update')->name('role.update');
        Route::delete('roles-delete/{id}', 'destroy')->name('role.destroy');
        Route::get('roles-show/{id}', 'show')->name('role.show');
    });

    // Roles Related Routes
    Route::controller(PermissionController::class)->group(function () {
        Route::get('permissions-index', 'index')->name('permissions.index');
        Route::view('permissions-create', 'permissions.create')->name('permission.create');
        Route::post('permissions-store', 'store')->name('permission.store');
        Route::get('permissions-edit/{id}', 'edit')->name('permission.edit');
        Route::put('permissions-update/{id}', 'update')->name('permission.update');
        Route::delete('permissions-destroy/{id}', 'destroy')->name('permission.destroy');
        Route::get('permissions-show/{id}', 'show')->name('permission.show');
    });

    // Tasks Related Routes
    Route::controller(TaskController::class)->group(function () {
        Route::get('tasks-index', 'index')->name('tasks.index');
        Route::view('tasks-create', 'tasks.create')->name('tasks.create');
        Route::post('tasks-store', 'store')->name('tasks.store');
        Route::get('tasks-edit/{id}', 'edit')->name('tasks.edit');
        Route::put('tasks-update/{id}', 'update')->name('tasks.update');
        Route::delete('tasks-delete/{id}', 'destroy')->name('tasks.destroy');
        Route::get('tasks-view/{id}', 'show')->name('tasks.view');
    });

    // Invoice Related Routes
    Route::view('invoices', 'invoices.invoice')->name('invoices.index');
    Route::view('payments', 'invoices.payments')->name('make.card.payments');
    Route::view('online-payment', 'invoices.make-pay-online')->name('make.pay.online');
    Route::view('checkout', 'invoices.make-payment')->name('invoices.checkout');

    // Activity Log
    Route::controller(ActivityController::class)->group(function () {
        Route::get('activity-log', 'index')->name('activity.log');
    });
    Route::view('chat', 'chat')->name('chat');
});

// Fallbacks & Error Routes
Route::view('404', '404')->name('404');
