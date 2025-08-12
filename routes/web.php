<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PermissionController;


Route::get('/countries', [LocationController::class, 'countries']);
Route::get('/states/{country_id}', [LocationController::class, 'states']);
Route::get('/cities/{state_id}', [LocationController::class, 'cities']);

// Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::view('login', 'auth.sign-in')->name('auth.sign-in');
    Route::view('register', 'auth.sign-up')->name('auth.sign-up');
    Route::view('reset-password', 'auth.reset-password')->name('auth.reset-password');

    Route::post('register', 'register')->name('register');
    Route::post('authenticate', 'authenticate')->name('authenticate')->middleware('throttle:10,1');
    Route::post('logout', 'logout')->name('logout');
    Route::get('auth/redirect', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
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
    Route::view('tasks-index', 'tasks.index')->name('tasks.index')->middleware('permission:view-task');
    Route::view('tasks-create', 'tasks.create')->name('tasks.create')->middleware('permission:create-task');
    Route::view('tasks-store', 'tasks.store')->name('tasks.store')->middleware('permission:create-task');
    Route::view('tasks-edit', 'tasks.edit')->name('tasks.edit')->middleware('permission:update-task');
    Route::view('tasks-update', 'tasks.update')->name('tasks.update')->middleware('permission:update-task');
    Route::view('tasks-delete', 'tasks.delete')->name('tasks.delete')->middleware('permission:delete-task');
    Route::view('tasks-view', 'tasks.view')->name('tasks.view')->middleware('permission:view-task');

    // Invoice Related Routes
    Route::view('invoices', 'invoices.invoice')->name('invoices.index');
    Route::view('payments', 'invoices.payments')->name('invoices.payments');
    Route::view('checkout', 'invoices.make-payment')->name('invoices.checkout');

    // Activity Log
    Route::controller(ActivityController::class)->group(function () {
        Route::get('activity-log', 'index')->name('activity.log');
    });
    Route::view('chat', 'chat')->name('chat');
});

// Fallbacks & Error Routes
Route::view('404', '404')->name('404');
